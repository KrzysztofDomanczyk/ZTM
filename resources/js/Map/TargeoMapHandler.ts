import {mapOptionsConfig, targeoKey, vehicleApiUrl} from "../config.js";
import {MapPoint} from "./MapPoint.js";
import {TargeoMap} from "./TargeoMap.js";

declare global {
    interface Window {
        Targeo: any;
    }
}

export class TargeoMapHandler {
    protected key: string;
    protected map?: TargeoMap;
    protected updateTimer: any = null;
    protected updateInterval: number = 6000;

    constructor() {
        this.key = targeoKey
    }

    public async initializeMap(): Promise<void> {
        console.log(window.Targeo);
        if (!window.Targeo) {
            setTimeout(() => this.initializeMap(), 100);
            console.error("Targeo is not available.");
            return;
        }

        this.map = new TargeoMap(mapOptionsConfig);

        this.map.initialize();

        console.log("Map initialized!");

        await this.setMarkers();
        await this.startAutoUpdate();
    }

    private async setMarkers(): Promise<void> {
        try {
            const response = await fetch(vehicleApiUrl);
            const vehicles: { lat: number, lon: number, vehicle_id: number }[] = await response.json();

            if (!vehicles) {
                console.error("Not found vehicles");
                return;
            }

            this.map?.removeMarkers();
            vehicles.forEach(vehicle => {
                let p1 = new MapPoint(vehicle.lon, vehicle.lat, vehicle.vehicle_id);
                this.map?.addMarker(p1);
            });

            console.log("Markers have been set");
        } catch (error) {
            console.error("Error while getting markers", error);
        }
    }

    private async startAutoUpdate(): Promise<void> {
        if (this.updateTimer) return;

        this.updateTimer = setInterval(() => {
            this.setMarkers().then();
        }, this.updateInterval);
    }

}


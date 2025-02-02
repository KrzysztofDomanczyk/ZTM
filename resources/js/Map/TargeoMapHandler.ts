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
        this.loadTargeoScript()
            .then(() => this.initializeMap())
            .catch((error) => console.error("Failed to load Targeo script:", error));
    }

    private async loadTargeoScript(): Promise<void> {
        if (window.Targeo) return;

        await new Promise<void>((resolve, reject) => {
            const script = document.createElement("script");
            script.src = "https://mapa.targeo.pl/Targeo.html?vn=3_0&k=" + this.key + "&f=TargeoMapInitialize&e=TargeoMapContainer&ln=pl";
            script.type = "text/javascript";
            script.onload = () => resolve();
            script.onerror = () => reject(new Error("Failed to load Targeo script."));
            document.head.appendChild(script);
        });

        await this.waitForTargeo();
    }

    private async waitForTargeo(): Promise<void> {
        while (!window.Targeo) {
            await new Promise((resolve) => setTimeout(resolve, 100));
        }
    }

    private initializeMap(): void {
        if (!window.Targeo) {
            console.error("Targeo is not available.");
            return;
        }

        this.map = new TargeoMap(mapOptionsConfig);

        this.map.initialize();

        console.log("Map initialized!");

        this.setMarkers().then();
        this.startAutoUpdate().then();
    }

    async setMarkers(): Promise<void> {
        console.log('Getting markers...');
        try {
            const response = await fetch(vehicleApiUrl);
            const vehicles: { lat: number, lon: number, vehicleId: number }[] = await response.json();
            console.log("Vehicles:", vehicles);

            if (!vehicles) {
                console.error("Not found vehicles");
                return;
            }

            this.map?.removeMarkers()

            vehicles.forEach(vehicle => {
                let p1 = new MapPoint(vehicle.lon, vehicle.lat, vehicle.vehicleId);
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


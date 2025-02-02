import {MapOptions} from "../Types/MapOption";
import {MapPoint} from "./MapPoint";


export class TargeoMap {
    protected map: any;
    protected points: MapPoint[] = [];

    constructor(mapOptionsConfig: MapOptions) {
        this.map = new window.Targeo.Map(mapOptionsConfig);
    }

    initialize() {
        this.map.initialize();
    }

    public   addMarker(marker: MapPoint): void  {
        this.map.UOAdd(marker.sourcePoint);
        this.points.push(marker);
    }
    public  removeMarkers(): void {
        this.points.forEach((marker: MapPoint) => {
            this.map.UORemove(marker.sourcePoint);
        });
        this.points = [];
    }
}


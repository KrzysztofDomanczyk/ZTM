
import {defaultMapPointOptions} from "../config.js";
export class MapPoint {
    public sourcePoint: any;
    constructor(public x: number, public y: number, public vehicleId: number) {
        this.sourcePoint = new window.Targeo.MapObject.Point(
            {x: x, y: y},
            defaultMapPointOptions,
            vehicleId,
            null
        );
    }

}


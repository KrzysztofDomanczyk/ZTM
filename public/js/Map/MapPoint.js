import { defaultMapPointOptions } from "../config.js";
export class MapPoint {
    constructor(x, y, vehicleId) {
        this.x = x;
        this.y = y;
        this.vehicleId = vehicleId;
        this.sourcePoint = new window.Targeo.MapObject.Point({ x: x, y: y }, defaultMapPointOptions, vehicleId, null);
    }
}

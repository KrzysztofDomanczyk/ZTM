export class TargeoMap {
    constructor(mapOptionsConfig) {
        this.points = [];
        this.map = new window.Targeo.Map(mapOptionsConfig);
    }
    initialize() {
        this.map.initialize();
    }
    addMarker(marker) {
        this.map.UOAdd(marker.sourcePoint);
        this.points.push(marker);
    }
    removeMarkers() {
        this.points.forEach((marker) => {
            this.map.UORemove(marker.sourcePoint.id);
        });
        this.points = [];
    }
}

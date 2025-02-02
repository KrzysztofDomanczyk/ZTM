export class Map {
    constructor(mapOptionsConfig) {
        this.map = new window.Targeo.Map(mapOptionsConfig);
    }
    initialize() {
        this.map.initialize();
    }
}

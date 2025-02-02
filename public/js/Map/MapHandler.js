var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { mapOptionsConfig } from "../config.js";
export class MapHandler {
    constructor() {
        this.updateTimer = null;
        this.updateInterval = 6000;
        this.markers = [];
        //TODO wyniesc
        this.key = 'ZjlhMmU2Nzc5OGQwNjczMWZkYWE2MGRlZTY1ZjRkY2U3M2E1M2ZkYg==';
        this.loadTargeoScript()
            .then(() => this.initializeMap())
            .catch((error) => console.error("Failed to load Targeo script:", error));
    }
    loadTargeoScript() {
        return __awaiter(this, void 0, void 0, function* () {
            if (window.Targeo)
                return;
            yield new Promise((resolve, reject) => {
                const script = document.createElement("script");
                //TODO wynieść do configu
                script.src = "https://mapa.targeo.pl/Targeo.html?vn=3_0&k=" + this.key + "&f=TargeoMapInitialize&e=TargeoMapContainer&ln=pl";
                script.type = "text/javascript";
                script.onload = () => resolve();
                script.onerror = () => reject(new Error("Failed to load Targeo script."));
                document.head.appendChild(script);
            });
            yield this.waitForTargeo();
        });
    }
    waitForTargeo() {
        return __awaiter(this, void 0, void 0, function* () {
            while (!window.Targeo) {
                yield new Promise((resolve) => setTimeout(resolve, 100));
            }
        });
    }
    initializeMap() {
        if (!window.Targeo) {
            console.error("Targeo is not available.");
            return;
        }
        this.map = new window.Targeo.Map(mapOptionsConfig);
        this.map.initialize();
        console.log("Map initialized!");
        this.setMarkers().then();
        this.startAutoUpdate();
    }
    startAutoUpdate() {
        if (this.updateTimer)
            return;
        this.updateTimer = setInterval(() => {
            this.setMarkers().then();
        }, this.updateInterval);
    }
    clearMarkers() {
        return __awaiter(this, void 0, void 0, function* () {
            this.markers.forEach(item => {
                this.map.UORemove(item.id);
            });
        });
    }
    setMarkers() {
        return __awaiter(this, void 0, void 0, function* () {
            try {
                //TODO url do configu
                //TODO obrazi url do config
                const response = yield fetch("https://ckan2.multimediagdansk.pl/gpsPositions?v=2");
                const data = yield response.json();
                //TODO obiekt
                const vehicles = data.vehicles;
                yield this.clearMarkers();
                vehicles.forEach(vehicle => {
                    //TODO clasa punktu
                    let p1 = new window.Targeo.MapObject.Point({ x: vehicle.lon, y: vehicle.lat }, {
                        imageUrl: 'https://mapa.targeo.pl/i/icons/pins/pin-b.png',
                        w: 27,
                        h: 28,
                        coordsAnchor: { x: 9, y: 25 },
                        z: {
                            24: {
                                imageUrl: 'https://mapa.targeo.pl/i/icons/pins/pinbig-b.png',
                                w: 38,
                                h: 39,
                                coordsAnchor: { x: 12, y: 36 }
                            }
                        }
                    }, vehicle.vehicleId, null);
                    this.markers.push(p1);
                    this.map.UOAdd(p1);
                });
                console.log("Zaktualizowano markery:");
            }
            catch (error) {
                console.error("Błąd podczas pobierania markerów:", error);
            }
        });
    }
}

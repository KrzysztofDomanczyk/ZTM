var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { mapOptionsConfig, targeoKey, vehicleApiUrl } from "../config.js";
import { MapPoint } from "./MapPoint.js";
import { TargeoMap } from "./TargeoMap.js";
export class TargeoMapHandler {
    constructor() {
        this.updateTimer = null;
        this.updateInterval = 6000;
        this.key = targeoKey;
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
        this.map = new TargeoMap(mapOptionsConfig);
        this.map.initialize();
        console.log("Map initialized!");
        this.setMarkers().then();
        this.startAutoUpdate().then();
    }
    setMarkers() {
        return __awaiter(this, void 0, void 0, function* () {
            var _a;
            console.log('Getting markers...');
            try {
                const response = yield fetch(vehicleApiUrl);
                const vehicles = yield response.json();
                console.log("Vehicles:", vehicles);
                if (!vehicles) {
                    console.error("Not found vehicles");
                    return;
                }
                (_a = this.map) === null || _a === void 0 ? void 0 : _a.removeMarkers();
                vehicles.forEach(vehicle => {
                    var _a;
                    let p1 = new MapPoint(vehicle.lon, vehicle.lat, vehicle.vehicleId);
                    (_a = this.map) === null || _a === void 0 ? void 0 : _a.addMarker(p1);
                });
                console.log("Markers have been set");
            }
            catch (error) {
                console.error("Error while getting markers", error);
            }
        });
    }
    startAutoUpdate() {
        return __awaiter(this, void 0, void 0, function* () {
            if (this.updateTimer)
                return;
            this.updateTimer = setInterval(() => {
                this.setMarkers().then();
            }, this.updateInterval);
        });
    }
}

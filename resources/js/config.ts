import {MapOptions} from "Types/MapOption";
export const mapOptionsConfig: MapOptions = {
    container: 'TargeoMapContainer',
    z: 22,
    c: { y: 54.3595085144043, x: 18.6477108001709 },
    modArguments: {
        Ribbon: { controls: ["MapMenu", "FTS", "FindRoute"] },
        Buildings3D: { disabled: false, on: true },
        POI: { disabled: false, submit: true, correct: true, visible: true },
        FTS: { disabled: false },
        FindRoute: { disabled: false },
        Traffic: { disabled: false, visible: false },
        Layers: { modes: ["map", "satellite"] },
    },
}

export const targeoKey: string = '';
export const vehicleApiUrl: string = 'http://localhost:8888/api/vehicles';

export const defaultMapPointOptions = {
    imageUrl: 'https://mapa.targeo.pl/i/icons/pins/pin-b.png',
    w: 27,
    h: 28,
    coordsAnchor: {x: 9, y: 25},
    z: {
        24: {
            imageUrl: 'https://mapa.targeo.pl/i/icons/pins/pinbig-b.png',
            w: 38,
            h: 39,
            coordsAnchor: {x: 12, y: 36}
        }
    }
}
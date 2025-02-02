export type MapModules = {
    Ribbon?: { controls: string[] };
    Buildings3D?: { disabled: boolean; on: boolean };
    POI?: { disabled: boolean; submit: boolean; correct: boolean; visible: boolean };
    FTS?: { disabled: boolean };
    FindRoute?: { disabled: boolean };
    Traffic?: { disabled: boolean; visible: boolean };
    Layers?: { modes: string[] };
};

export type MapOptions = {
    container: HTMLElement | string;
    z?: number;
    c?: { x: number; y: number };
    modArguments?: MapModules;
};

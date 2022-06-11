const ParseValueToColor = (value) => {
    const colors = {
        '#570DF8': 80,
        '#37CDBE': 60,
        '#3D4451': 40,
        '#FBBD23': 20,
        '#470000': 0
    };
    return Object.keys(colors).find(key => colors[key] <= value);
}

export { ParseValueToColor };
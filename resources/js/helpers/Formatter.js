const getColorByValue = (value) => {
    const colors = {
        '#570DF8': 80,
        '#37CDBE': 60,
        '#3D4451': 40,
        '#FBBD23': 20,
        '#F87272': 0
    };
    return Object.keys(colors).find(key => colors[key] <= value);
}

export { getColorByValue };
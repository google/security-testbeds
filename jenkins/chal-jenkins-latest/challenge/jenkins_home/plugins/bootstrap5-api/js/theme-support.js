if (window.getThemeManagerProperty) {
    const setBsTheme = () => document.body.dataset['bsTheme'] = getThemeManagerProperty('bootstrap', 'theme');
    setBsTheme();

    if (window.isSystemRespectingTheme) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
            setBsTheme()
        });
    }
}
(function (d, s, j) {
    if (!s)
        return;

    function getTheme() {
        return s.getItem("theme");
    }

    function setTheme(theme) {
        j.setTheme(theme);

        s.setItem("theme", theme);
    }

    j.onReady(function () {
        d.querySelector("#theme-switcher").addEventListener("click", function () {
            const current_theme = getTheme();

            if (current_theme === null || current_theme === "philly_light")
                setTheme("philly_dark");
            else
                setTheme("philly_light");
        });
    });

    const selected_theme = getTheme();
    if (selected_theme === null || !['philly_light', 'philly_dark'].includes(selected_theme))
        return;

    setTheme(selected_theme);
})(document, localStorage, jtd);

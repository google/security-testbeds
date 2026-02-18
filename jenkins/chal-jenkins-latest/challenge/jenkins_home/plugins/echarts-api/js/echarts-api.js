/* exported echartsJenkinsApi */

const trendDefaultStorageId = 'jenkins-echarts-trend-configuration-default';
const echartsJenkinsApi = {
    /**
     * Resolves all Jenkins colors within the specified string model. These colors are specified as CSS variables
     * of the form <code>--color-name</code>. The method replaces all occurrences of these variables with the actual
     * color value of the current Jenkins theme.
     *
     * @param {String} model - the model to escape the Jenkins colors
     * @returns {String} the escaped string
     */
    resolveJenkinsColors: function (model) {
        return model.replaceAll(/--([a-z-]+)/g, function (match) {
            return echartsJenkinsApi.resolveJenkinsColor(match)
        })
    },

    /**
     * Returns the theme-aware color of all texts.
     *
     * @return {string|string}
     */
    getTextColor: function () {
        return echartsJenkinsApi.resolveJenkinsColor('--text-color');
    },

    /**
     * Returns the theme-aware color of all texts.
     *
     * @return {string|string}
     */
    resolveJenkinsColor: function (colorName) {
        return getComputedStyle(document.body).getPropertyValue(colorName) || '#333';
    },

    /**
     * Escapes the meta characters of the specified string so that the string can be used as an ID.
     *
     * @param {String} string - the string to escape
     * @returns {String} the escaped string
     */
    escapeMetaCharacters: function (string) {
        return string.replaceAll(/[.*+?^${}()|[\]\\]/g, '\\$&')
    },

    /**
     * Reads the specified configuration from the local storage.
     *
     * @param {String} id - the ID of the configuration
     * @return the configuration or {} if no such configuration is found
     */
    readFromLocalStorage: function (id) {
        try {
            const configuration = localStorage.getItem(id);
            if (configuration) {
                return JSON.parse(configuration);
            }
        }
        catch (e) {
            // ignore any errors
        }
        return {};
    },

    /**
     * Reads the trend configuration from the local storage and merges it with the default configuration.
     *
     * @param {String} id - the ID of the configuration
     * @return the configuration or {} if no such configuration is found
     */
    readConfiguration: function (id) {
        const specific = echartsJenkinsApi.readFromLocalStorage(id);
        const common = echartsJenkinsApi.readFromLocalStorage(trendDefaultStorageId);

        return Object.assign(specific, common);
    },

    /**
     * Configures the content of the trend configuration  dialog.
     *
     * @param {String} suffix - the suffix for the ID of the affected trend configuration dialog
     * @param {Function} fillDialog - a function to fill the configuration dialog with additional values from the JSON
     *     configuration object
     * @param {Function} saveDialog - a function to save the configuration dialog values to the JSON configuration object
     */
    configureTrend: function (suffix, fillDialog, saveDialog) {
        const trendConfiguration = jQuery3('#trend-configuration-' + suffix);
        const numberOfBuildsInput = trendConfiguration.find('#builds-' + suffix);
        const numberOfDaysInput = trendConfiguration.find('#days-' + suffix);
        const useBuildAsDomainCheckBox = trendConfiguration.find('#build-domain-' + suffix);
        const widthSlider = trendConfiguration.find('#width-' + suffix);
        const heightSlider = trendConfiguration.find('#height-' + suffix);
        const trendLocalStorageId = 'jenkins-echarts-trend-configuration-' + suffix;
        const saveButton = '#save-trend-configuration-' + suffix;

        function setDefaultValues() {
            numberOfBuildsInput.val(50);
            numberOfDaysInput.val(0);
            useBuildAsDomainCheckBox.prop('checked', true);
            widthSlider.val(500);
            heightSlider.val(200);
            if (fillDialog) {
                fillDialog(trendConfiguration, {});
            }
        }

        trendConfiguration.on('show.bs.modal', function (e) {
            const trendJsonConfiguration = echartsJenkinsApi.readConfiguration(trendLocalStorageId);
            if (jQuery3.isEmptyObject(trendJsonConfiguration)) {
                setDefaultValues();
            }
            else {
                try {
                    numberOfBuildsInput.val(trendJsonConfiguration.numberOfBuilds);
                    numberOfDaysInput.val(trendJsonConfiguration.numberOfDays);
                    useBuildAsDomainCheckBox.prop('checked', trendJsonConfiguration.buildAsDomain === 'true');
                    widthSlider.val(trendJsonConfiguration.width);
                    widthSlider.next().html(trendJsonConfiguration.width)
                    heightSlider.val(trendJsonConfiguration.height);
                    heightSlider.next().html(trendJsonConfiguration.height)
                    if (fillDialog) {
                        fillDialog(trendConfiguration, trendJsonConfiguration);
                    }
                }
                catch (e) {
                    setDefaultValues();
                }
            }
        });

        jQuery3(saveButton).on('click', function (e) {
            const configurationJson = {
                numberOfBuilds: numberOfBuildsInput.val(),
                numberOfDays: numberOfDaysInput.val(),
                buildAsDomain: useBuildAsDomainCheckBox.prop('checked') ? 'true' : 'false',
                width: widthSlider.val(),
                height: heightSlider.val()
            };
            localStorage.setItem(trendDefaultStorageId, JSON.stringify(configurationJson));
            if (saveDialog) {
                const specific = saveDialog(trendConfiguration);
                localStorage.setItem(trendLocalStorageId, JSON.stringify(specific));
            }
        });

        trendConfiguration.on('keypress', function (e) {
            if (e.which === 13) {
                jQuery3(saveButton).click();
            }
        });

        const slider = jQuery3('.range-slider');
        const range = jQuery3('.range-slider-range');
        const value = jQuery3('.range-slider-value');

        slider.each(function() {
            value.each(function() {
                const value = jQuery3(this).prev().attr('value');
                jQuery3(this).html(value);
            });

            range.on('input', function() {
                jQuery3(this).next(value).html(this.value);
            });
        });
    },

    /**
     * Configures the content of the trend configuration dialog.
     *
     * @param {String} suffix - the suffix for the ID of the affected trend configuration dialog
     *     configuration object
     */
    configureChart: function (suffix) {
        const chartConfiguration = jQuery3('#chart-configuration-' + suffix);
        const numberOfBuildsInput = chartConfiguration.find('#builds-' + suffix);
        const numberOfDaysInput = chartConfiguration.find('#days-' + suffix);
        const useBuildAsDomainCheckBox = chartConfiguration.find('#build-domain-' + suffix);
        const trendLocalStorageId = 'jenkins-echarts-chart-configuration-' + suffix;
        const saveButton = '#save-chart-configuration-' + suffix;

        function setDefaultValues() {
            numberOfBuildsInput.val(50);
            numberOfDaysInput.val(0);
            useBuildAsDomainCheckBox.prop('checked', true);
        }

        chartConfiguration.on('show.bs.modal', function (e) {
            const trendJsonConfiguration = echartsJenkinsApi.readFromLocalStorage(trendLocalStorageId);
            if (jQuery3.isEmptyObject(trendJsonConfiguration)) {
                setDefaultValues();
            }
            else {
                try {
                    numberOfBuildsInput.val(trendJsonConfiguration.numberOfBuilds);
                    numberOfDaysInput.val(trendJsonConfiguration.numberOfDays);
                    useBuildAsDomainCheckBox.prop('checked', trendJsonConfiguration.buildAsDomain === 'true');
                }
                catch (e) {
                    setDefaultValues();
                }
            }
        });

        jQuery3(saveButton).on('click', function (e) {
            const configurationJson = {
                numberOfBuilds: numberOfBuildsInput.val(),
                numberOfDays: numberOfDaysInput.val(),
                buildAsDomain: useBuildAsDomainCheckBox.prop('checked') ? 'true' : 'false',
            };
            localStorage.setItem('jenkins-echarts-chart-configuration-' + suffix, JSON.stringify(configurationJson));
        });

        chartConfiguration.on('keypress', function (e) {
            if (e.which === 13) {
                jQuery3(saveButton).click();
            }
        });
    },

    /**
     * Renders a configurable trend chart in the specified div using ECharts.
     *
     * @param {String} chartDivId - the ID of the div where the chart should be shown in
     * @param {String} model - the line chart model
     * @param {String} settingsDialogId - the optional ID of the div that provides a settings dialog (might be set to null
     *     if there is no such dialog)
     * @param {Function} chartClickedEventHandler - the optional event handler that receives click events
     * @param {Boolean} allowYAxisZoom - Allow zooming on the y-axis
     */
    renderConfigurableZoomableTrendChart: function (chartDivId, model, settingsDialogId, chartClickedEventHandler, allowYAxisZoom = false) {
        const themedModel = echartsJenkinsApi.resolveJenkinsColors(model);
        const chartModel = JSON.parse(themedModel);
        const chartPlaceHolder = document.getElementById(chartDivId);
        const chart = echarts.init(chartPlaceHolder);
        chartPlaceHolder.echart = chart;

        const textColor = getComputedStyle(document.body).getPropertyValue('--text-color') || '#333';
        const showSettings = document.getElementById(settingsDialogId);

        function getDataZoomOptions(allowYAxisZoom) {
            var dataZoomOptions = [
                {
                    type: 'inside'
                },
                {
                    type: 'slider',
                    height: 25,
                    bottom: 5,
                    moveHandleSize: 5,
                    xAxisIndex: [0],
                    filterMode: 'filter',
                }
            ];

            if (allowYAxisZoom) {
                dataZoomOptions.push({
                    type: 'slider',
                    width: 25,
                    right: 5,
                    moveHandleSize: 5,
                    yAxisIndex: [0],
                    filterMode: 'empty'
                });
            }

            return dataZoomOptions;
        };

        const options = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross',
                    label: {
                        backgroundColor: '#6a7985'
                    }
                }
            },
            toolbox: {
                show: showSettings != null,
                itemSize: 16,
                feature: {
                    myTool1: {
                        title: 'Setup',
                        icon: 'ipath://M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z',
                        onclick: function () {
                            new bootstrap5.Modal(showSettings).show();
                        }
                    }
                }
            },
            dataZoom: getDataZoomOptions(allowYAxisZoom),
            legend: {
                orient: 'horizontal',
                type: 'scroll',
                x: 'center',
                y: 'top',
                textStyle: {
                    color: textColor
                }
            },
            grid: {
                left: '20',
                right: allowYAxisZoom ? '40' : '10',
                bottom: '35',
                top: '40',
                containLabel: true
            },
            xAxis: [{
                type: 'category',
                boundaryGap: false,
                data: chartModel.domainAxisLabels,
                axisLabel: {
                    color: textColor
                }
            }],
            yAxis: [{
                type: 'value',
                min: chartModel.rangeMin ?? 'dataMin',
                max: chartModel.rangeMax ?? 'dataMax',
                axisLabel: {
                    color: textColor
                },
                minInterval: chartModel.integerRangeAxis ? 1 : null
            }],
            series: chartModel.series
        };
        chart.setOption(options);
        chart.resize();
        if (chartClickedEventHandler !== null) {
            chart.getZr().on('click', params => {
                const offset = 30;
                if (params.offsetY > offset && chart.getHeight() - params.offsetY > offset) { // skip the legend and data zoom
                    const pointInPixel = [params.offsetX, params.offsetY];
                    const pointInGrid = chart.convertFromPixel('grid', pointInPixel);
                    const buildDisplayName = chart.getModel().get('xAxis')[0].data[pointInGrid[0]]
                    chartClickedEventHandler(buildDisplayName);
                }
            })
        }
        jQuery3(window).resize(function () {
            chart.resize();
        });
    },

    /**
     * Renders a trend chart in the specified div using ECharts.
     *
     * @param {String} chartDivId - the ID of the div where the chart should be shown in
     * @param {String} enableLinks - determines if the chart is clickable. If the chart is clickable, then clicking on a
     *     chart will open the results of the selected build.
     * @param {String} configurationId - ID of the div-element that renders a configuration dialog of this trend chart.
     *     If this element is defined, then the trend chart will use a configuration button that
     *     will invoke the specified element. If your trend has no special configuration dialog
     *     then the ID "defaultTrendConfiguration" of the default configuration dialog should be used.
     * @param {Object} ajaxProxy - AJAX proxy of the endpoint in Jenkins Java model object
     */
    renderConfigurableTrendChart: function (chartDivId, enableLinks, configurationId, ajaxProxy) {
        function hasConfigurationDialog() {
            return configurationId != null && configurationId.length > 0;
        }

        function getConfigurationDialog() {
            return document.getElementById('trend-configuration-' + configurationId);
        }

        function createOptions(chartModel) {
            const textColor = getComputedStyle(document.body).getPropertyValue('--text-color') || '#333';
            return {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    },
                },
                toolbox: {
                    itemSize: 16,
                    show: hasConfigurationDialog(),
                    feature: {
                        myTool1: {
                            title: 'Setup',
                            icon: 'ipath://M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z',
                            onclick: function () {
                                new bootstrap5.Modal(getConfigurationDialog()).show();
                            }
                        }
                    }
                },
                legend: {
                    orient: 'horizontal',
                    type: 'scroll',
                    pageButtonPosition: 'start',
                    x: 'center',
                    y: 'top',
                    textStyle: {
                        color: textColor
                    }
                },
                grid: {
                    left: '20',
                    right: '10',
                    bottom: '10',
                    top: '30',
                    containLabel: true
                },
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: chartModel.domainAxisLabels,
                    axisLabel: {
                        color: textColor
                    }
                }
                ],
                yAxis: [{
                    type: 'value',
                    min: chartModel.rangeMin ?? 'dataMin',
                    max: chartModel.rangeMax ?? 'dataMax',
                    axisLabel: {
                        color: textColor
                    },
                    minInterval: chartModel.integerRangeAxis ? 1 : null
                }
                ],
                series: chartModel.series
            };
        }

        /**
         * Redraws a trend chart in the specified div using ECharts.
         *
         * @param {Object} chart - the ECharts instance
         * @param {String} model - the line chart model received from the Ajax call
         */
        function redraw(chart, model) {
            chart.hideLoading();
            const themedModel = echartsJenkinsApi.resolveJenkinsColors(model);
            const chartModel = JSON.parse(themedModel);
            chart.setOption(createOptions(chartModel), true);
            chart.resize();

            if (!!(enableLinks && enableLinks !== "false")) {
                chartPlaceHolder.model = chartModel;

                const urlName = chartPlaceHolder.getAttribute("tool");
                if (urlName) {
                    chart.getZr().on('click', params => {
                        if (params.offsetY > 30) { // skip the legend
                            const pointInPixel = [params.offsetX, params.offsetY];
                            const pointInGrid = chart.convertFromPixel('grid', pointInPixel);
                            const buildDisplayName = chart.getModel().get('xAxis')[0].data[pointInGrid[0]]
                            const builds = chartPlaceHolder.model.buildNumbers;
                            const labels = chartPlaceHolder.model.domainAxisLabels;

                            let selectedBuild = 0;
                            for (let i = 0; i < builds.length; i++) {
                                if (buildDisplayName === labels[i]) {
                                    selectedBuild = builds[i];
                                    break;
                                }
                            }

                            if (selectedBuild > 0) {
                                window.location.assign(selectedBuild + '/' + urlName);
                            }
                        }
                    })
                }
            }
        }

        function renderAsynchronously(chart) {
            const configuration = echartsJenkinsApi.readConfiguration('jenkins-echarts-trend-configuration-' + configurationId);
            ajaxProxy.getConfigurableBuildTrendModel(JSON.stringify(configuration), function (trendModel) {
                redraw(chart, trendModel.responseJSON);
            });
        }

        function setHeight(trend, configuration) {
            const height = configuration.height + "px";
            trend.style.height = height;
            trend.style.minHeight = height;
        }

        function setWidth(trend, configuration) {
            const width = configuration.width + "px";
            trend.style.width = width;
            trend.style.minWidth = width;
        }

        function setSize(trend, localStorageId) {
            const configuration = echartsJenkinsApi.readConfiguration(localStorageId);
            if (configuration && configuration.height) {
                setHeight(trend, configuration);
            }
            if (configuration && configuration.width) {
                setWidth(trend, configuration);
            }
        }

        const chartPlaceHolder = document.getElementById(chartDivId);

        const chart = echarts.init(chartPlaceHolder);
        chart.showLoading();
        chartPlaceHolder.echart = chart;

        window.onresize = function () {
            chart.resize();
        };

        if (hasConfigurationDialog()) {
            const localStorageId = 'jenkins-echarts-trend-configuration-' + configurationId;
            setSize(chartPlaceHolder, localStorageId);
            renderAsynchronously(chart);

            const redrawChartEvent = "echarts.trend.changed";
            document.addEventListener(redrawChartEvent, function () {
                renderAsynchronously(chart);
            });
            if (window.getThemeManagerProperty && window.isSystemRespectingTheme) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
                    renderAsynchronously(chart);
                });
            }

            getConfigurationDialog().addEventListener("hidden.bs.modal", function () {
                const configuration = echartsJenkinsApi.readConfiguration(localStorageId);
                const trends = document.getElementsByClassName("echarts-trend");
                for (let i = 0; i < trends.length; i++) {
                    setSize(trends[i], configuration);
                }

                const event = new Event(redrawChartEvent);
                document.dispatchEvent(event);
            });
        }
        else { // AsyncTrendChart
            ajaxProxy.getBuildTrendModel(function (trendModel) {
                redraw(chart, trendModel.responseJSON);
            });
        }
    },

    /**
     * Renders a trend chart in the specified div using ECharts.
     *
     * @param {String} chartDivId - the ID of the div where the chart should be shown in
     * @param {String} enableLinks - determines if the chart is clickable. If the chart is clickable, then clicking on a
     *     chart will open the results of the selected build.
     * @param {Object} ajaxProxy - AJAX proxy of the endpoint in Jenkins Java model object
     */
    renderTrendChart: function (chartDivId, enableLinks, ajaxProxy) {
        echartsJenkinsApi.renderConfigurableTrendChart(chartDivId, enableLinks, null, ajaxProxy);
    },

    /**
     * Renders all div elements that have the class 'echarts-pie-chart' using ECharts.
     */
    renderPieCharts: function () {
        /**
         * Renders a trend chart in a div using ECharts.
         *
         * @param {String} chartDivId - the ID of the div where the chart should be shown in
         */
        function renderPieChart(chartDivId) {
            function isEmpty(string) {
                return (!string || string.length === 0);
            }

            /**
             * Returns the title properties of the chart.
             *
             * @param {String} title - the title
             */
            function getTitle(title) {
                if (!isEmpty(title)) {
                    return {
                        text: title,
                        textStyle: {
                            fontWeight: 'normal',
                            fontSize: '16'
                        },
                        left: 'center'
                    };
                }
                else {
                    return null;
                }
            }

            const chartPlaceHolder = jQuery3("#" + echartsJenkinsApi.escapeMetaCharacters(chartDivId));
            const model = JSON.parse(chartPlaceHolder.attr('data-chart-model'));
            const themedColors = model.colors.map(color => color.replaceAll(/--([a-z-]+)/g, function (match) {
                return echartsJenkinsApi.resolveJenkinsColor(match)
            }));
            const title = chartPlaceHolder.attr('data-title');
            const chartDiv = chartPlaceHolder[0];
            const chart = echarts.init(chartDiv);
            chartDiv.echart = chart;

            const textColor = echartsJenkinsApi.getTextColor();

            const options = {
                title: getTitle(title),
                tooltip: {
                    trigger: 'item',
                    formatter: '{b}: {c} ({d}%)'
                },
                legend: {
                    orient: 'horizontal',
                    x: 'center',
                    y: 'bottom',
                    type: 'scroll',
                    textStyle: {
                        color: textColor
                    }
                },
                series: [{
                    type: 'pie',
                    radius: ['30%', '70%'],
                    avoidLabelOverlap: false,
                    color: themedColors,
                    label: {
                        normal: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            show: false
                        }
                    },
                    labelLine: {
                        normal: {
                            show: true
                        }
                    },
                    data: model.data
                }
                ]
            };
            chart.setOption(options);
            chart.resize();

            const useLinks = chartPlaceHolder.attr('data-links');
            if (useLinks && useLinks !== "false") {
                chart.on('click', function (params) {
                    window.location.assign(params.name);
                });
            }

            return chart;
        }

        const allPieCharts = jQuery3('div.echarts-pie-chart');
        const pieChartInstances = [];
        allPieCharts.each(function () {
            const chart = jQuery3(this);
            const id = chart.attr('id');

            pieChartInstances.push(renderPieChart(id));
        });
        if (pieChartInstances.length > 0) {
            jQuery3(window).resize(function () {
                pieChartInstances.forEach(function (chartInstance) {
                    chartInstance.resize();
                });
            });
        }
    }
}

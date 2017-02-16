// Donut Chart
$('#{field}').Morris.Donut({
element: '{field}',
        data: [
        {donuts}
        { label: "{label}", value: {value} },
        {/donuts}
        ],
        resize: true
});

@section('content')
{{-- <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="card-subtitle text-muted">Total Users</h6>
                    <i class="bi bi-people fs-4 text-primary"></i>
                </div>
                <h2 class="card-title mb-0">1,234</h2>
                <p class="card-text mt-2">
                    <span class="text-success me-1"><i class="bi bi-arrow-up"></i> 20.1%</span>
                    <small class="text-muted">from last month</small>
                </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="card-subtitle text-muted">Active Tests</h6>
                    <i class="bi bi-file-earmark-check fs-4 text-success"></i>
                </div>
                <h2 class="card-title mb-0">23</h2>
                <p class="card-text mt-2">
                    <span class="text-success me-1"><i class="bi bi-arrow-up"></i> 12</span>
                    <small class="text-muted">tests this week</small>
                </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="card-subtitle text-muted">Completion Rate</h6>
                    <i class="bi bi-bar-chart fs-4 text-warning"></i>
                </div>
                <h2 class="card-title mb-0">87.4%</h2>
                <p class="card-text mt-2">
                    <span class="text-success me-1"><i class="bi bi-arrow-up"></i> 4.3%</span>
                    <small class="text-muted">from last week</small>
                </p>
            </div>
        </div>
    </div>
</div> --}}
<script src="https://d3js.org/d3.v7.min.js"></script>
<div id="chart" style="position: relative;"></div>

<script>
// Convert the Laravel data to JSON format
var data = @json($data);

// Set dimensions and margins for the chart
var width = screen.width/100*70, height = 400, margin = 50;

// Create an SVG container
var svg = d3.select("#chart")
      .append("svg")
      .attr("width", width)
      .attr("height", height)
      .append("g")
      .attr("transform", `translate(${margin}, ${margin})`);

// Set the scale for the X axis
var x0 = d3.scaleBand()
     .range([0, width - 2 * margin])
     .domain(data.map(d => d.label))  // Test date
     .padding(0.2);

// Set the scale for the inner X axis (for grouped bars)
var x1 = d3.scaleBand()
     .domain(['correct', 'incorrect'])  // Two bars for correct and incorrect
     .range([0, x0.bandwidth()])
     .padding(0.1);

// Set the scale for the Y axis (max value between correct and incorrect)
var y = d3.scaleLinear()
    .domain([0, d3.max(data, d => Math.max(d.correct, d.incorrect))])
    .nice()
    .range([height - 2 * margin, 0]);

// Define gradient colors for the bars
var colors = {
correct: "url(#correct-gradient)",  // Use gradient for correct answers
incorrect: "url(#incorrect-gradient)"  // Use gradient for incorrect answers
};

// Define the gradients for correct and incorrect bars
svg.append("defs")
.append("linearGradient")
.attr("id", "correct-gradient")
.attr("x1", "0%").attr("y1", "0%")
.attr("x2", "0%").attr("y2", "100%")
.call(g => {
 g.append("stop").attr("offset", "0%").attr("stop-color", "#4CAF50");  // Green
 g.append("stop").attr("offset", "100%").attr("stop-color", "#3E8E41");  // Darker green
});

svg.append("defs")
.append("linearGradient")
.attr("id", "incorrect-gradient")
.attr("x1", "0%").attr("y1", "0%")
.attr("x2", "0%").attr("y2", "100%")
.call(g => {
 g.append("stop").attr("offset", "0%").attr("stop-color", "#F44336");  // Red
 g.append("stop").attr("offset", "100%").attr("stop-color", "#D32F2F");  // Darker red
});

// Add X axis (dates)
svg.append("g")
.attr("transform", `translate(0, ${height - 2 * margin})`)
.call(d3.axisBottom(x0).tickSizeOuter(0));

// Add Y axis
svg.append("g")
.call(d3.axisLeft(y).ticks(5));

// Create groups for the bars
// Create groups for the bars
var bars = svg.selectAll(".bars")
.data(data)
.enter()
.append("g")
.attr("transform", d => `translate(${x0(d.label)}, 0)`);

// Add correct answer bars
bars.selectAll(".bar.correct")
.data(d => [{key: 'correct', value: d.correct, url: d.correct_url}]) // Add a `url` property for navigation
.enter()
.append("a") // Wrap the bar with <a>
.attr("xlink:href", d => d.url) // Set the link
.attr("target", "_blank") // Optional: Open in new tab
.append("rect")
.attr("class", "bar correct")
.attr("x", d => x1(d.key))
.attr("y", y(0))
.attr("width", x1.bandwidth())
.attr("height", 0)
.attr("fill", colors.correct)
.attr("rx", 10)
.attr("ry", 10)
.on("mouseover", function(event, d) {
showTooltip(event, `Correct: ${d.value}`);
d3.select(this).style("opacity", 0.8);
})
.on("mouseout", function() {
hideTooltip();
d3.select(this).style("opacity", 1);
})
.transition()
.duration(1000)
.attr("y", d => y(d.value))
.attr("height", d => height - 2 * margin - y(d.value));

// Add incorrect answer bars
bars.selectAll(".bar.incorrect")
.data(d => [{key: 'incorrect', value: d.incorrect, url: d.incorrect_url}]) // Add a `url` property for navigation
.enter()
.append("a") // Wrap the bar with <a>
.attr("xlink:href", d => d.url) // Set the link
.attr("target", "_blank") // Optional: Open in new tab
.append("rect")
.attr("class", "bar incorrect")
.attr("x", d => x1(d.key))
.attr("y", y(0))
.attr("width", x1.bandwidth())
.attr("height", 0)
.attr("fill", colors.incorrect)
.attr("rx", 10)
.attr("ry", 10)
.on("mouseover", function(event, d) {
showTooltip(event, `Incorrect: ${d.value}`);
d3.select(this).style("opacity", 0.8);
})
.on("mouseout", function() {
hideTooltip();
d3.select(this).style("opacity", 1);
})
.transition()
.duration(1000)
.attr("y", d => y(d.value))
.attr("height", d => height - 2 * margin - y(d.value));

// Add a title
svg.append("text")
.attr("x", (width - 2 * margin) / 2)
.attr("y", -20)
.attr("text-anchor", "middle")
.attr("font-size", "18px")
.attr("font-weight", "bold")
.text("Player Performance: Correct vs. Incorrect");

// Tooltip functionality
var tooltip = d3.select("#chart")
          .append("div")
          .style("position", "absolute")
          .style("background", "#fff")
          .style("border", "1px solid #ccc")
          .style("padding", "5px 10px")
          .style("border-radius", "5px")
          .style("box-shadow", "0 0 5px rgba(0,0,0,0.2)")
          .style("opacity", 0);

function showTooltip(event, text) {
tooltip.style("opacity", 1)
     .html(text)
     .style("left", (event.pageX + 10) + "px")
     .style("top", (event.pageY - 28) + "px");
}

function hideTooltip() {
tooltip.style("opacity", 0);
}
</script>
<div id="chart2" style="position: relative;"></div>

<script>
// Convert the Laravel data to JSON format
var data = @json($mostFailedSections);

// Set dimensions and margins for the chart
var width = screen.width/100*80, height = 400, margin = 50;

// Create an SVG container
var svg = d3.select("#chart2")
      .append("svg")
      .attr("width", width)
      .attr("height", height)
      .append("g")
      .attr("transform", `translate(${margin}, ${margin})`);

// Set the scale for the X axis
var x0 = d3.scaleBand()
     .range([0, width - 2 * margin])
     .domain(data.map(d => d.label))  // Test date
     .padding(0.2);

// Set the scale for the inner X axis (for grouped bars)
var x1 = d3.scaleBand()
     .domain(['correct', 'incorrect'])  // Two bars for correct and incorrect
     .range([0, x0.bandwidth()])
     .padding(0.1);

// Set the scale for the Y axis (max value between correct and incorrect)
var y = d3.scaleLinear()
    .domain([0, d3.max(data, d => Math.max(0, d.failed))])
    .nice()
    .range([height - 2 * margin, 0]);

// Define gradient colors for the bars
var colors = {
correct: "url(#correct-gradient)",  // Use gradient for correct answers
incorrect: "url(#incorrect-gradient)"  // Use gradient for incorrect answers
};

// Define the gradients for correct and incorrect bars
svg.append("defs")
.append("linearGradient")
.attr("id", "correct-gradient")
.attr("x1", "0%").attr("y1", "0%")
.attr("x2", "0%").attr("y2", "100%")
.call(g => {
 g.append("stop").attr("offset", "0%").attr("stop-color", "#4CAF50");  // Green
 g.append("stop").attr("offset", "100%").attr("stop-color", "#3E8E41");  // Darker green
});

svg.append("defs")
.append("linearGradient")
.attr("id", "incorrect-gradient")
.attr("x1", "0%").attr("y1", "0%")
.attr("x2", "0%").attr("y2", "100%")
.call(g => {
 g.append("stop").attr("offset", "0%").attr("stop-color", "#F44336");  // Red
 g.append("stop").attr("offset", "100%").attr("stop-color", "#D32F2F");  // Darker red
});

// Add X axis (dates)
svg.append("g")
.attr("transform", `translate(0, ${height - 2 * margin})`)
.call(d3.axisBottom(x0).tickSizeOuter(0));

// Add Y axis
svg.append("g")
.call(d3.axisLeft(y).ticks(5));

// Create groups for the bars
// Create groups for the bars
var bars = svg.selectAll(".bars")
.data(data)
.enter()
.append("g")
.attr("transform", d => `translate(${x0(d.label)}, 0)`);

// Add correct answer bars
bars.selectAll(".bar.correct")
.data(d => [{key: 'correct', value: d.failed, url: d.correct_url}]) // Add a `url` property for navigation
.enter()
.append("a") // Wrap the bar with <a>
.attr("xlink:href", d => d.url) // Set the link
.attr("target", "_blank") // Optional: Open in new tab
.append("rect")
.attr("class", "bar correct")
.attr("x", d => x1(d.key))
.attr("y", y(0))
.attr("width", x1.bandwidth()/2)
.attr("height", 0)
.attr("fill", colors.correct)
.attr("rx", 10)
.attr("ry", 10)
.on("mouseover", function(event, d) {
showTooltip(event, `Correct: ${d.value}`);
d3.select(this).style("opacity", 0.8);
})
.on("mouseout", function() {
hideTooltip();
d3.select(this).style("opacity", 1);
})
.transition()
.duration(1000)
.attr("y", d => y(d.value))
.attr("height", d => height - 2 * margin - y(d.value));

// Add incorrect answer bars
bars.selectAll(".bar.incorrect")
.data(d => [{key: 'incorrect', value: d.incorrect, url: d.incorrect_url}]) // Add a `url` property for navigation
.enter()
.append("a") // Wrap the bar with <a>
.attr("xlink:href", d => d.url) // Set the link
.attr("target", "_blank") // Optional: Open in new tab
.append("rect")
.attr("class", "bar incorrect")
.attr("x", d => x1(d.key))
.attr("y", y(0))
.attr("width", x1.bandwidth())
.attr("height", 0)
.attr("fill", colors.incorrect)
.attr("rx", 10)
.attr("ry", 10)
.on("mouseover", function(event, d) {
showTooltip(event, `Incorrect: ${d.value}`);
d3.select(this).style("opacity", 0.8);
})
.on("mouseout", function() {
hideTooltip();
d3.select(this).style("opacity", 1);
})
.transition()
.duration(1000)
.attr("y", d => y(d.value))
.attr("height", d => height - 2 * margin - y(d.value));

// Add a title
svg.append("text")
.attr("x", (width - 2 * margin) / 2)
.attr("y", -20)
.attr("text-anchor", "middle")
.attr("font-size", "18px")
.attr("font-weight", "bold")
.text("most failed sections");

// Tooltip functionality
var tooltip = d3.select("#chart")
          .append("div")
          .style("position", "absolute")
          .style("background", "#fff")
          .style("border", "1px solid #ccc")
          .style("padding", "5px 10px")
          .style("border-radius", "5px")
          .style("box-shadow", "0 0 5px rgba(0,0,0,0.2)")
          .style("opacity", 0);

function showTooltip(event, text) {
tooltip.style("opacity", 1)
     .html(text)
     .style("left", (event.pageX + 10) + "px")
     .style("top", (event.pageY - 28) + "px");
}

function hideTooltip() {
tooltip.style("opacity", 0);
}
</script>
<div id="chart3" style="position: relative;"></div>

<script>
// Convert the Laravel data to JSON format
var data = @json($allFailedTests);

// Set dimensions and margins for the chart
var width = screen.width/100*80, height = 400, margin = 50;

// Create an SVG container
var svg = d3.select("#chart3")
      .append("svg")
      .attr("width", width)
      .attr("height", height)
      .append("g")
      .attr("transform", `translate(${margin}, ${margin})`);

// Set the scale for the X axis
var x0 = d3.scaleBand()
     .range([0, width - 2 * margin])
     .domain(data.map(d => d.label))  // Test date
     .padding(0.2);

// Set the scale for the inner X axis (for grouped bars)
var x1 = d3.scaleBand()
     .domain(['correct', 'incorrect'])  // Two bars for correct and incorrect
     .range([0, x0.bandwidth()])
     .padding(0.1);

// Set the scale for the Y axis (max value between correct and incorrect)
var y = d3.scaleLinear()
    .domain([0, d3.max(data, d => Math.max(0, d.failed))])
    .nice()
    .range([height - 2 * margin, 0]);

// Define gradient colors for the bars
var colors = {
correct: "url(#correct-gradient)",  // Use gradient for correct answers
incorrect: "url(#incorrect-gradient)"  // Use gradient for incorrect answers
};

// Define the gradients for correct and incorrect bars
svg.append("defs")
.append("linearGradient")
.attr("id", "correct-gradient")
.attr("x1", "0%").attr("y1", "0%")
.attr("x2", "0%").attr("y2", "100%")
.call(g => {
 g.append("stop").attr("offset", "0%").attr("stop-color", "#4CAF50");  // Green
 g.append("stop").attr("offset", "100%").attr("stop-color", "#3E8E41");  // Darker green
});

svg.append("defs")
.append("linearGradient")
.attr("id", "incorrect-gradient")
.attr("x1", "0%").attr("y1", "0%")
.attr("x2", "0%").attr("y2", "100%")
.call(g => {
 g.append("stop").attr("offset", "0%").attr("stop-color", "#F44336");  // Red
 g.append("stop").attr("offset", "100%").attr("stop-color", "#D32F2F");  // Darker red
});

// Add X axis (dates)
svg.append("g")
.attr("transform", `translate(0, ${height - 2 * margin})`)
.call(d3.axisBottom(x0).tickSizeOuter(0));

// Add Y axis
svg.append("g")
.call(d3.axisLeft(y).ticks(5));

// Create groups for the bars
// Create groups for the bars
var bars = svg.selectAll(".bars")
.data(data)
.enter()
.append("g")
.attr("transform", d => `translate(${x0(d.label)}, 0)`);

// Add correct answer bars
bars.selectAll(".bar.correct")
.data(d => [{key: 'correct', value: d.failed, url: d.correct_url}]) // Add a `url` property for navigation
.enter()
.append("a") // Wrap the bar with <a>
.attr("xlink:href", d => d.url) // Set the link
.attr("target", "_blank") // Optional: Open in new tab
.append("rect")
.attr("class", "bar correct")
.attr("x", d => x1(d.key))
.attr("y", y(0))
.attr("width", x1.bandwidth())
.attr("height", 0)
.attr("fill", colors.correct)
.attr("rx", 10)
.attr("ry", 10)
.on("mouseover", function(event, d) {
showTooltip(event, `Correct: ${d.value}`);
d3.select(this).style("opacity", 0.8);
})
.on("mouseout", function() {
hideTooltip();
d3.select(this).style("opacity", 1);
})
.transition()
.duration(1000)
.attr("y", d => y(d.value))
.attr("height", d => height - 2 * margin - y(d.value));

// Add incorrect answer bars
bars.selectAll(".bar.incorrect")
.data(d => [{key: 'incorrect', value: d.incorrect, url: d.incorrect_url}]) // Add a `url` property for navigation
.enter()
.append("a") // Wrap the bar with <a>
.attr("xlink:href", d => d.url) // Set the link
.attr("target", "_blank") // Optional: Open in new tab
.append("rect")
.attr("class", "bar incorrect")
.attr("x", d => x1(d.key))
.attr("y", y(0))
.attr("width", x1.bandwidth())
.attr("height", 0)
.attr("fill", colors.incorrect)
.attr("rx", 10)
.attr("ry", 10)
.on("mouseover", function(event, d) {
showTooltip(event, `Incorrect: ${d.value}`);
d3.select(this).style("opacity", 0.8);
})
.on("mouseout", function() {
hideTooltip();
d3.select(this).style("opacity", 1);
})
.transition()
.duration(1000)
.attr("y", d => y(d.value))
.attr("height", d => height - 2 * margin - y(d.value));

// Add a title
svg.append("text")
.attr("x", (width - 2 * margin) / 2)
.attr("y", -20)
.attr("text-anchor", "middle")
.attr("font-size", "18px")
.attr("font-weight", "bold")
.text("Most Failed tests");

// Tooltip functionality
var tooltip = d3.select("#chart")
          .append("div")
          .style("position", "absolute")
          .style("background", "#fff")
          .style("border", "1px solid #ccc")
          .style("padding", "5px 10px")
          .style("border-radius", "5px")
          .style("box-shadow", "0 0 5px rgba(0,0,0,0.2)")
          .style("opacity", 0);

function showTooltip(event, text) {
tooltip.style("opacity", 1)
     .html(text)
     .style("left", (event.pageX + 10) + "px")
     .style("top", (event.pageY - 28) + "px");
}

function hideTooltip() {
tooltip.style("opacity", 0);
}
</script>

@endsection


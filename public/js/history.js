var base_url_prefix = base_url + "api/admin/",
    totalRecords = 0,
    records = [],
    displayRecords = [],
    filterSearch = "",
    orderByCol = "id",
    orderByAct = "desc",
    dateSearch = "",
    recPerPage = 15;

count_post = (page = null) => {
    urltxt = base_url_prefix + "article"
    url = page != null ? urltxt + "?page=" + page : urltxt + "?page=1"
    var params = { action: 'history', limit : $("#max").children("option:selected").val() }
    set_ajax(url, params, "null", function(response) {

        records = response.data
        var pagination = response.meta.pagination
        var total = pagination.total_pages
        if (total != 0) {
            set_object();
        }

    })
}

set_object = () => {
    $no = 1;
    $element = ""
    records.map(d => {
        $element += '<tr>'
        $element += '<td>' + d.id + '</td><td style="max-width:40%;">' + d.title + '</td>' +
            '<td style="word-wrap: break-word;white-space:normal;max-width:25%;">' + d.engage + '</td>'
        $element += '</tr>'
    })
    $("#tableBody").html($element)
}


sorting = async(kolom, element) => {
    orderByCol = kolom;
    $(".sortstatus").removeClass('sortstatus');
    $('.fa-sort-up').removeClass('fa-sort-up');
    $('.fa-sort-down').removeClass('fa-sort-down');
    ((orderByAct == "asc") ? orderByAct = "desc" : orderByAct = "asc");
    if (orderByAct == "desc") {
        $("#" + element).removeClass('sortstatus fa fa-sort-up');
        $("#" + element).addClass('sortstatus fa fa-sort-down');
        // $(".sortstatus").removeClass("fa fa-sort-down");
        // $(".sortstatus").addClass("fa fa-sort-up");
    } else {
        $("#" + element).removeClass('sortstatus fa fa-sort-down');
        $("#" + element).addClass('sortstatus fa fa-sort-up');
        // $(".sortstatus").removeClass("fa fa-sort-up");
        // $(".sortstatus").addClass("fa fa-sort-down");
    }
    count_post();
}

$("#find").on('click', function(e) {
    e.preventDefault();
    filterSearch = $("#search-name").val();
    dateSearch = $("#filter-date").val();
    count_post();
})

$("#reload").on('click', function(e) {
    e.preventDefault();
    $("#search-name").val("");
    $("#filter-date").val("");
    filterSearch = "";
    dateSearch = "";
    count_post();

})


$("#reloadpost").on('click', function(e) {
    var url = base_url_prefix + "/reloadall"
    var params = { fpid }
    set_ajax(url, params, "tableLoading", function(response) {
        if (response.result == true) {
            count_post();
        }
    });

})

get_chart =() => {
    urltxt = base_url_prefix + "lasthistory"
    var params = {limit : $("#max").children("option:selected").val()}
    set_ajax(urltxt, params, "null", function(response) {
        $('#myChart').remove(); // this is my <canvas> element
         $('#chart-container').append('<canvas id="myChart"><canvas>');
        var ctx = $('#myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: response.labels,
                datasets: [{
                    label: 'Engagement Rank',
                    data: response.values,
                    backgroundColor: response.colors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        
        console.log(response);
    })
}

$("select#max").change(function(){
    count_post();
    get_chart();
})

$(document).ready(function() {
    // console.log(fpid);
    count_post();
    get_chart();
        // $('#filter-date').bootstrapMaterialDatePicker({
        //     weekStart: 0,
        //     time: false,
        //     maxDate: new Date(),
        // })

})
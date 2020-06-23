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
    urltxt = base_url_prefix + "similarity"
    url = page != null ? urltxt + "?page=" + page : urltxt + "?page=1"
    var params = { search: filterSearch }
    set_ajax(url, params, "null", function(response) {

        records = response.data
        var pagination = response.meta.pagination
        var total = pagination.total_pages
        if (total != 0) {
            localStorage.setItem('total_page', total)
            set_object();
            if (!$('#pagination').data("twbs-pagination")) {
                apply_pagination();
            }
        } else {
            $("#tableBody_dice").html("<tr><td colspan='4'><h4 class='text-danger text-center'>Data Not Found</h4></td></tr>");
            $("#tableBody_jaccard").html("<tr><td colspan='4'><h4 class='text-danger text-center'>Data Not Found</h4></td></tr>");
            if ($('#pagination').data("twbs-pagination")) {
                $('.pagination').twbsPagination('destroy');
            }
        }

    })
}

apply_pagination = () => {
    if ($('#pagination').data("twbs-pagination")) {
        $('.pagination').twbsPagination('destroy');
    }
    $('#pagination').twbsPagination({
        totalPages: localStorage.getItem('total_page') ? localStorage.getItem('total_page') : 0,
        visiblePages: 5,
        onPageClick: function(event, page) {
            count_post(page)
        }
    });
}

set_object = () => {
    $no = 1;
    $element = ""
    $element_jaccard = ""
    records.map(d => {
        $element += '<tr>'
        $element += '<td>' + d.id + '</td><td style="word-wrap: break-word;white-space:normal;max-width:5%;">' + d.title + '</td>' +
            '<td>' + d.dice.recomendation_id + '</td><td style="word-wrap: break-word;white-space:normal;max-width:25%;">' + d.dice.percent.replace(/,/g, '<br/>') + '</td>'
        $element += '</tr>'

        $element_jaccard += '<tr>'
        $element_jaccard += '<td>' + d.id + '</td><td style="word-wrap: break-word;white-space:normal;max-width:5%;">' + d.title + '</td>' +
            '<td>' + d.jaccard.recomendation_id + '</td><td style="word-wrap: break-word;white-space:normal;max-width:25%;">' + d.jaccard.percent.replace(/,/g, '<br/>') + '</td>'
        $element_jaccard += '</tr>'
    })
    $("#tableBody_dice").html($element)
    $("#tableBody_jaccard").html($element_jaccard)

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

get_compare =() => {
    urltxt = base_url_prefix + "compare"
    var params = {total : $("#max").children("option:selected").val()}
    set_ajax(urltxt, params, "null", function(response) {
        $(".total_data").text(response.detail.total)
        $(".total_sama").text(response.detail.same)
        $(".total_berbeda").text(response.detail.not_same)
        $(".max_recom").text(response.detail.max_recom)
        $('#myChart').remove(); // this is my <canvas> element
         $('#chart-container').append('<canvas id="myChart"><canvas>');
        var ctx = $('#myChart');
        var myDoughnutChart = new Chart(ctx, {
            type: 'pie',
            data: response.chart,
        });
        
        console.log(response);
    })
}

$("select#max").change(function(){
    get_compare();
})

$(document).ready(function() {
    // console.log(fpid);
    apply_pagination()
    get_compare()
        // $('#filter-date').bootstrapMaterialDatePicker({
        //     weekStart: 0,
        //     time: false,
        //     maxDate: new Date(),
        // })

})
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
    urltxt = base_url_prefix + "preprocessing"
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
            $("#tableBody").html("<tr><td colspan='6'><h4 class='text-danger text-center'>Data Not Found</h4></td></tr>");
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
        totalPages: localStorage.getItem('total_page'),
        visiblePages: 5,
        onPageClick: function(event, page) {
            count_post(page)
        }
    });
}



set_object = () => {
    $no = 1;
    $element = ""
    records.map(d => {
        $element += '<tr>'
        $element += '<td style="max-width:2%;">' + d.id + '</td><td style="word-wrap: break-word;white-space:normal;max-width:5%;">' + d.title + '</td>' +
            '<td style="word-wrap: break-word;white-space:normal;max-width:25%;">' + d.real_content +
            '<td style="word-wrap: break-word;white-space:normal;max-width:25%;">' + d.filter +
            '</td><td style="word-wrap: break-word;white-space:normal;max-width:20%;">' + d.tokenize +
            '<td style="word-wrap: break-word;white-space:normal;max-width:20%;">' + d.content + '</td>'
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


$(document).ready(function() {
    // console.log(fpid);
    apply_pagination()
        // $('#filter-date').bootstrapMaterialDatePicker({
        //     weekStart: 0,
        //     time: false,
        //     maxDate: new Date(),
        // })

})
var base_url_prefix = base_url + "api/admin/"

$("#startCrawl").on('click', function(e) {
    $("#consoletext").html('LOADING....')
    console.log('jalan');
    url = base_url_prefix + "crawl"

    var params = {}
    set_ajax(url, params, "null", function(response) {

        $("#consoletext").html(response)
    })
})

$("#startDice").on('click', function(e) {
    $("#consoletext").html('LOADING....')
    console.log('jalan');
    url = base_url_prefix + "dice"

    var params = {}
    set_ajax(url, params, "null", function(response) {

        $("#consoletext").html(response)
    })
})

$("#startJaccard").on('click', function(e) {
    $("#consoletext").html('LOADING....')
    console.log('jalan');
    url = base_url_prefix + "jaccard"

    var params = {}
    set_ajax(url, params, "null", function(response) {

        $("#consoletext").html(response)
    })
})
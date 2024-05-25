
$(document).on('click', '.matchActionMenu', function () {

    var match_id = $(this).attr("id");

    $('.addQuestion').attr({
        id: match_id
    });
    $('.updateMatch').attr({
        id: match_id
    });
    $('.deleteMatch').attr({
        id: match_id
    });
    $('.closeMatch').attr({
        id: match_id
    });


});

$(document).on('click', '.questionActionMenu', function () {

    var question_id = $(this).attr("id");

    $('.addAns').attr({
        id: question_id
    });
    $('.updateQuestion').attr({
        id: question_id
    });
    $('.deleteQuestion').attr({
        id: question_id
    });
    $('.closeQuestion').attr({
        id: question_id
    });


});
$(document).on('click', '.toLive', function () {
    var toLive = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            toLive: toLive
        },
        success: function (data) {
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.updateMatch', function () {
//update match select or show
    $('#matchActionMenu').modal('hide');
    var match_id = $(this).attr("id");

    $('#bettingIdForAddQuestion').val(match_id);
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        dataType: "json",
        data: {
            updateMatchSelect: match_id
        },
        success: function (data) {
            $('#Update_A_team').val(data.A_team);
            $('#Update_B_team').val(data.B_team);
            $('#Update_title').val(data.title);
            $('#Update_date').val(data.date);
            $('.matchIdForUpdate').attr({
                id: match_id
            });

            //$("#matchShow").html(data);
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');

        }
    });

});
$(document).on('click', '.updateQuestion', function () {
//update match select or show
    $('#questionActionMenu').modal('hide');
    var question_id = $(this).attr("id");

    $('#bettingIdForAddQuestion').val(question_id);
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        dataType: "json",
        data: {
            updateQuestionSelect: question_id
        },
        success: function (data) {
            $('#editQuestion').val(data.title);

            $('.questionIdForUpdate').attr({
                id: question_id
            });

            //$("#matchShow").html(data);

            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.updateAnsRate', function () {
//update match select or show
    var ans_id = $(this).attr("id");
    var tt = $(this).attr("tt");
    // $('#bettingIdForAddQuestion').val(ans_id);

    $('#editAnswer').val(tt);

    $('.ansIdForUpdate').attr({
        id: ans_id
    });



});

$(document).on('click', '#addMatchSubmit', function (event) {
    event.preventDefault();
    var A_team = $('#A_team').val();
    var B_team = $('#B_team').val();
    var title = $('#title').val();
    var date = $('#date').val();
    var status = $("#status:checked").val();
    var gameType = $("#gameType:checked").val();
    var addMatch = 1;

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            A_team: A_team,
            B_team: B_team,
            title: title,
            date: date,
            status: status,
            gameType: gameType,
            addMatch: addMatch

        },
        success: function (data) {

            $('#A_team').val('');
            $('#B_team').val('');
            $('#title').val('');
            $('#date').val('');
            $("#addMatchSuccess").html(data);

            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#addMatchSubmitDefault', function (event) {
    event.preventDefault();
    var A_team = $("#A_team").val();
    var B_team = $("#B_team").val();
    var title = $('#title').val();
    var date = $('#date').val();
    var status = $("#status:checked").val();

    var gameType = $("#gameType:checked").val();
    var addMatchDefault = 1;
    if ($("input:radio[id='status2']").is(":checked")) {
        var status2 = $("#status2:checked").val();

    } else {
        var status2 = 0;

    }
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            A_team: A_team,
            B_team: B_team,
            title: title,
            date: date,
            status: status,
            gameType: gameType,
            status2: status2,
            addMatchDefault: addMatchDefault

        },
        success: function (data) {

            $("#addMatchSuccess").html(data);

            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#updateMatchSubmit', function (event) {
    event.preventDefault();
    var A_team = $('#Update_A_team').val();
    var B_team = $('#Update_B_team').val();
    var title = $('#Update_title').val();
    var date = $('#Update_date').val();
    var status = $("#Update_status:checked").val();
    var gameType = $("#Update_gameType:checked").val();
    var updateMatch = 1;
    var match_id = $('.matchIdForUpdate').attr("id");

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            A_team: A_team,
            B_team: B_team,
            title: title,
            date: date,
            status: status,
            gameType: gameType,
            updateMatch: updateMatch,
            match_id_for_update: match_id

        },
        success: function (data) {

            $('#Update_A_team').val('');
            $('#Update_B_team').val('');
            $('#Update_title').val('');
            $('#Update_date').val('');
            $("#UpdateMatchSuccess").html(data);

            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#updateQuestionSubmit', function (event) {
    event.preventDefault();
    var editQuestion = $('#editQuestion').val();

    var updateQuestion = 1;
    var question_id = $('.questionIdForUpdate').attr("id");

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            editQuestion: editQuestion,
            updateQuestion: updateQuestion,
            question_id_for_update: question_id

        },
        success: function (data) {

            $('#editQuestion').val('');

            $("#UpdateQuestionSuccess").html(data);

            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#updateAnsSubmit', function (event) {
    event.preventDefault();
    var editAnswer = $('#editAnswer').val();
    var editRateAmount = $('#editRateAmount').val();
    var updateAns = 1;
    var ans_id = $('.ansIdForUpdate').attr("id");

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            editAnswer: editAnswer,
            updateAns: updateAns,
            editRateAmount: editRateAmount,
            ans_id_for_update: ans_id

        },
        success: function (data) {

            $('#editAnswer').val('');
            $('#editRateAmount').val('');
            $("#UpdateAnsSuccess").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.addQuestion', function () {

    $('#matchActionMenu').modal('hide');
    var match_id = $(this).attr("id");

    $('#bettingIdForAddQuestion').val(match_id);
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id: match_id
        },
        success: function (data) {

            $("#matchShow").html(data);

            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#addQuestionSubmit', function (event) {
    event.preventDefault();
    var match_id = $('#bettingIdForAddQuestion').val();
    var addQuestion = $('#addQustionOfMatch').val();

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_q: match_id,
            addQuestion: addQuestion
        },
        success: function (data) {

            $('#addQustionOfMatch').val('');
            $("#addQustionSuccess").html(data);
            // action-sub-betting-id<?php echo $bettingTitle['id'] ?>
            // $('#action-sub-betting-id<script>document.write(match_id)</script>').modal('hide');  
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.addAns', function () {

    $('#questionActionMenu').modal('hide');
    var question_id = $(this).attr("id");
    $('#questionIdForAddAns').val(question_id);

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id: question_id
        },
        success: function (data) {

            $("#questionShowOfAddAns").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');

        }
    });

});
$(document).on('click', '#addAnsSubmit', function (event) {
    event.preventDefault();
    var questionIdForAddAns = $('#questionIdForAddAns').val();
    var addAns = $('#addAnsField').val();
    var addAnsRate = $('#addAnsRate').val();
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            questionIdForAddAns: questionIdForAddAns,
            addAns: addAns,
            addAnsRate: addAnsRate
        },
        success: function (data) {

            $('#addAnsField').val('');
            $('#addAnsRate').val('');
            $("#addAnsSuccess").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
//limit match
$(document).on('click', '.limitMatch', function () {

    var match_id = $(this).attr("id");
    $('#matchIdForLimit').val(match_id);
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id: match_id
        },
        success: function (data) {

            $("#matchShowOfLimit").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');

        }
    });

});
$(document).on('click', '.scoreM', function () {

    var match_id = $(this).attr("id");
    $('#matchIdForScore').val(match_id);



});
$(document).on('click', '.deleteMatch', function () {

    var match_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            deleteMatch: match_id
        },
        success: function (data) {

            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.closeMatch', function () {

    var match_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            closeMatch: match_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.deleteQuestion', function () {

    var question_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            deleteQuestion: question_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.deleteAns', function () {

    var ans_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            deleteAns: ans_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.closeQuestion', function () {

    var question_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            closeQuestion: question_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#limitRateForMatchSubmit', function (event) {
    event.preventDefault();
    var match_id = $('#matchIdForLimit').val();
    var limitRateForMatch = $('#limitRateForMatch').val();

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_limit: match_id,
            limitRateForMatch: limitRateForMatch
        },
        success: function (data) {

            $('#limitRateForMatch').val('');
            $("#limitMatchSuccess").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#score', function (event) {
    event.preventDefault();
    var match_id = $('#matchIdForScore').val();
    var score = $('#ScoreRateForMatch').val();

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_score: match_id,
            score: score
        },
        success: function (data) {

            $('#ScoreRateForMatch').val('');
            $("#scoreSuc").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');

        }
    });

});
//match waith
$(document).on('click', '.matchWatting', function () {

    var match_id = $(this).attr("id");
    $('#matchIdForWait').val(match_id);
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id: match_id
        },
        success: function (data) {

            $("#matchShowOfWait").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#matchWattingTimeSubmit', function (event) {
    event.preventDefault();
    var match_id = $('#matchIdForWait').val();
    var matchWaittingRate = $('#matchWaittingRate').val();

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_wait: match_id,
            matchWaittingRate: matchWaittingRate
        },
        success: function (data) {

            $('#matchWaittingRate').val('');
            $("#waitMatchSuccess").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
//match Stop or active
$(document).on('click', '.matchStop', function (event) {
    event.preventDefault();
    var match_id = $(this).attr("id");

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_stop: match_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.matchActive', function (event) {
    event.preventDefault();
    var match_id = $(this).attr("id");

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_active: match_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});

//match hide or show
$(document).on('click', '.matchHide', function (event) {
    event.preventDefault();
    var match_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_hide: match_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.matchShow', function (event) {
    event.preventDefault();
    var match_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_show: match_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
//match aria hide or aria show
$(document).on('click', '.matchAriaHide', function (event) {
    event.preventDefault();
    var match_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_aria_hide: match_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.matchAriaShow', function (event) {
    event.preventDefault();
    var match_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_aria_show: match_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
//match matchHideFromPanel
$(document).on('click', '.matchHideFromPanel', function (event) {
    event.preventDefault();
    var match_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            match_id_for_HideFromPanel: match_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});

//limit question
$(document).on('click', '.questionlimit', function () {

    var question_id = $(this).attr("id");
    $('#questionIdForLimit').val(question_id);
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id: question_id
        },
        success: function (data) {

            $("#questionShowOfLimit").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.limitAns', function () {
//select
    var ans_id = $(this).attr("id");
    $('#ansIdForLimit').val(ans_id);
    var limitAnsSelect = 1;

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        dataType: "json",
        data: {
            ans_id_for_limitSelect: ans_id,
            limitAnsSelect: limitAnsSelect
        },
        success: function (data) {

            $("#ansShowOfLimit").html(data.title);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#limitRateForQuestionSubmit', function (event) {
    event.preventDefault();
    var question_id = $('#questionIdForLimit').val();
    var limitRateForQuestion = $('#limitRateForQuestion').val();
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id_for_limit: question_id,
            limitRateForQuestion: limitRateForQuestion
        },
        success: function (data) {

            $('#limitRateForQuestion').val('');
            $("#limitQuestionSuccess").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#limitRateForAnsSubmit', function (event) {
    event.preventDefault();
    var ans_id = $('#ansIdForLimit').val();
    var limitRateAmount = $('#limitRateAmount').val();
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            ans_id_for_limit: ans_id,
            limitRateForAns: limitRateAmount
        },
        success: function (data) {

            $('#limitRateAmount').val('');
            $("#limitAnsSuccess").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
//question waith
$(document).on('click', '.questionWatting', function () {

    var question_id = $(this).attr("id");
    $('#questionIdForWait').val(question_id);

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id: question_id
        },
        success: function (data) {

            $("#questionShowOfWait").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '#questionWattingTimeSubmit', function (event) {
    event.preventDefault();
    var question_id = $('#questionIdForWait').val();
    var questionhWaittingRate = $('#questionWaittingRate').val();

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id_for_wait: question_id,
            questionhWaittingRate: questionhWaittingRate
        },
        success: function (data) {

            $('#matchWaittingRate').val('');
            $("#waitMatchSuccess").html(data);
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
//question Stop or active
$(document).on('click', '.questionStop', function (event) {
    event.preventDefault();
    var question_id = $(this).attr("id");

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id_for_stop: question_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.questionActive', function (event) {
    event.preventDefault();
    var question_id = $(this).attr("id");

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id_for_active: question_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});

//question hide or show
$(document).on('click', '.questionHide', function (event) {
    event.preventDefault();
    var question_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id_for_hide: question_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.questionShow', function (event) {
    event.preventDefault();
    var question_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id_for_show: question_id
        },
        success: function (data) {

        }
    });

});
//question aria hide or aria show
$(document).on('click', '.questionhAriaHide', function (event) {
    event.preventDefault();
    var question_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id_for_aria_hide: question_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.questionAriaShow', function (event) {
    event.preventDefault();
    var question_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id_for_aria_show: question_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
//
//ans Stop or active
$(document).on('click', '.ansStop', function (event) {
    event.preventDefault();
    var ans_id = $(this).attr("id");

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            ans_id_for_stop: ans_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.ansActive', function (event) {
    event.preventDefault();
    var ans_id = $(this).attr("id");

    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            ans_id_for_active: ans_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});

//question hide or show
$(document).on('click', '.questionHide', function (event) {
    event.preventDefault();
    var question_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id_for_hide: question_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.questionShow', function (event) {
    event.preventDefault();
    var question_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            question_id_for_show: question_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
//ans hide or show
$(document).on('click', '.ansHide', function (event) {
    event.preventDefault();
    var ans_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            ans_id_for_hide: ans_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.ansShow', function (event) {
    event.preventDefault();
    var ans_id = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            ans_id_for_show: ans_id
        },
        success: function (data) {
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.hiddenToLive', function (event) {
    event.preventDefault();
    var hiddenToPanel = $(this).attr("id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            hiddenToPanel: hiddenToPanel
        },
        success: function (data) {
            $("#hiddenContentShow").load('hiddenContent.php');
            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.defaultHiddenToLive', function (event) {
    event.preventDefault();
    var defaultHiddenToLiveId = $(this).attr("id");
    var hiddenId = $(this).attr("hidden-id");
    var match_id = $(this).attr("match-id");
    $.ajax({
        method: "POST",
        url: "betPanelDataFetch.php",
        data: {
            defaultHiddenToLiveId: defaultHiddenToLiveId
        },
        success: function (data) {
            $("#hiddenSectionShow").load('hiddenSection.php?hiddenId=' + hiddenId + "&match_id=" + match_id);

            //page refresh
            $("#liveMatchFetch").load('betLiveContent.php');
            $("#upcomingContent").load('upcomingMatch.php');
        }
    });

});
$(document).on('click', '.section', function (event) {
    event.preventDefault();
    var hiddenId = $(this).attr("id");
    var g_type = $(this).attr("g-type");
    var match_id = $('.m-default').attr("id");
    $('#default').modal("hide");

    $("#hiddenSectionShow").load('hiddenSection.php?hiddenId=' + hiddenId + "&g_type=" + g_type + "&match_id=" + match_id);

});
$(document).on('click', '.matchActiondefault', function (event) {
    event.preventDefault();
    var match_id = $(this).attr("id");

    $('.m-default').attr({
        id: match_id
    });


});

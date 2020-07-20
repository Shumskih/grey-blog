function getName(userName) {
    event.preventDefault();
    document.querySelector("textarea[name=message]").value=(userName) + ', ';
    document.getElementById("messageDiv").scrollIntoView();
}

function reply(userName, parentId) {
    event.preventDefault();
    document.getElementById("parentId").value=(parentId);
    getName(userName);
}

function showAnswers(number) {
    if (document.getElementById('replies-'+number).style.display === "none") {
        document.getElementById('replies-'+number).style.display = "block";
        document.getElementById('showAnswers-'+number).style.display = "none";
        document.getElementById('hideAnswers-'+number).style.display = "block";
    }
}

function hideAnswers(number) {
    if (document.getElementById('replies-'+number).style.display === "block") {
        document.getElementById('replies-'+number).style.display = "none";
        document.getElementById('showAnswers-'+number).style.display = "block";
        document.getElementById('hideAnswers-'+number).style.display = "none";
    }
}



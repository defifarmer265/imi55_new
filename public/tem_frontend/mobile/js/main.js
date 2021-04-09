var goals = {
    playNow: 19,
    tryNow: 20,
    siteId: 15,
    registerSuccess: 3,
    signupSuccess: 1,
    iosDownload: 2,
    androidDownload: 3
}

var isEnable = true;
var piwikUrl = "//trk.liveperson88.com/";

window.betMobile.PiwikConfig = {
    goals: goals
    , isEnable: isEnable
    , url: piwikUrl
}
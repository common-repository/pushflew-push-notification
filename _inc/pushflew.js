jQuery(document).ready(function($) {
    var s = document.createElement("script");
    var siteId = pushflew_Object.websiteId;
    s.src = "https://cdn.pushflew.com/cs/" + siteId + ".js";
    s.async = true;
    document.documentElement.appendChild(s);
});

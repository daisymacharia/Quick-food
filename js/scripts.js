$(document).ready(function () {
    $('.confirm').on('click', function (e) {
        return confirm('Are you sure?');
    })
});

SetNavActive($('.list-inline li a'), 'active');

function SetNavActive(links, cls) {
    $(links).each(function (i, link) {

        link = $(link);
        var url = link.attr('href');

        var path = window.location.href;
        var file = path.substr(path.lastIndexOf("/") + 1);
        file = file.split('?')[0];

        if (file == url) {
            link.parent().addClass(cls);

        } else {
            link.parent().removeClass(cls);
        }
    });
}
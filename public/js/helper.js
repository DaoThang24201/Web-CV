
function convertTime(date) {
    let u = new Date(date)
    return (
        u.getUTCFullYear() +
        '-' + ('0' + u.getUTCMonth()).slice(-2) +
        '-' + ('0' + u.getUTCDate()).slice(-2) +
        ' ' + ('0' + u.getUTCHours()).slice(-2) +
        ':' + ('0' + u.getUTCMinutes()).slice(-2)
    )
}

function renderPagination(links) {
    links.forEach(function (each) {
        $('#pagination').append($('<li>').attr('class', `page-item  ${each.active ? 'active' : ''}`)
            .append(`<a class="page-link" href="${each.url}">${each.label}</a>`));
    })
}

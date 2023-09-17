export function insertParam(key, value) {
    if (typeof key == 'object'){

        var kvp = document.location.search.substr(1).split('&');
        if (kvp == '') {
            var query = '';
            for (var index in key){
                query += index+'='+key[index]+'&';
            }
            query = query.slice(0,'-1');
            addUrlToHistory('?' + query);
            // document.location.search = '?' + query;
        }
        else {
            var j = {};
            for (var index in key){
                j[index] = 0;
            }
            var i = kvp.length; var x; while (i--) {
                x = kvp[i].split('=');


                for (var index in key){

                    if (x[0] == index) {
                        x[1] = key[index];
                        kvp[i] = x.join('=');
                        j[index]++;
                    }
                }

            }
            var k = 0;
            for (var index in key){
                if (j[index] == 0){
                    kvp[kvp.length+k] = [index, key[index]].join('=');
                    k++;
                }
            }
            addUrlToHistory(kvp.join('&'));
            // document.location.search = kvp.join('&');
        }

    }else{
        key = escape(key);
        var kvp = document.location.search.substr(1).split('&');

        if (kvp == '') {
            addUrlToHistory('?' + key + '=' + value);
            // document.location.search = '?' + key + '=' + value;
        }
        else {

            var page = $.grep(kvp, function (item, index) {
                return item.trim().match(/^page/);
            });
            if (page.length > 0){
                var page_index = kvp.indexOf(page[0]);
                if (page_index !== -1){
                    kvp.splice(page_index,1);
                }
            }
            var i = kvp.length; var x; while (i--) {
                x = kvp[i].split('=');
                if(key.endsWith("%5B%5D")){
                    var decodedValue = decodeURIComponent(x[1]);
                    if ((x[0] == key && value == decodedValue) && (decodeURIComponent(x[1]) == value || x[1] == encodeURIComponent(value) || value == decodedValue.replace(/\+/g,' ')  || value == x[1]) ) {
                        kvp.splice(i,1);
                        break;
                    }
                }else{
                    if (x[0] == key) {
                        x[1] = value;
                        kvp[i] = x.join('=');
                        break;
                    }
                }
            }
            if (i < 0) { kvp[kvp.length] = [key, value].join('='); }
            addUrlToHistory(kvp.join('&'));
            // document.location.search = kvp.join('&');
        }
    }
}
export function removeParam(key) {
    var sourceURL = document.location.href;
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (typeof key == 'object'){
                key.forEach(function(entry) {
                    if (param === entry) {
                        params_arr.splice(i, 1);
                    }
                });
            }else{
                if (param === key) {
                    params_arr.splice(i, 1);
                }
            }
        }
        rtn = rtn + "?" + params_arr.join("&");
    }
    addUrlToHistory(rtn);
    // document.location =rtn;
    // return rtn;
}

export function getUrlQueryParams(location)
{
    let qd = {};
    if (location.search) location.search.substr(1).split("&").forEach(function(item) {
        let s = item.split("="),
            k = s[0],
            v = s[1] && decodeURIComponent(s[1]); //  null-coalescing / short-circuit
        //(k in qd) ? qd[k].push(v) : qd[k] = [v]
        (qd[k] = qd[k] || []).push(v) // null-coalescing / short-circuit
    })
    return qd
}

function addUrlToHistory(url)
{
    if (!url.includes('http://') && !url.includes('https://')) {
        if (!url.includes('?')) {
            url = '?' + url;
        }
        url = window.location.protocol + "//" + window.location.host + window.location.pathname + url;
    }
    window.history.pushState({path: url}, '', url);
}

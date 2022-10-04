const limit = 25;
let page = 1,
    subdomain = '',
    getContactsListQueryUrl = 'https://' + subdomain + '.amocrm.ru/api/v4/contacts',
    createTasks = 'https://' + subdomain + '.amocrm.ru/api/v4/tasks',
    arr = [],
    i,
    contacts,
    company,
    task,
    tasks,
    id;

function sendAjax(url, method, _function, _with) {
    $.ajax({
        url: url,
        method: method,
        contentType: 'application/json',
        data: {
            limit: limit,
            with: _with,
            page: page
        }
    })
    .done(_function)
    .fail(function(data) {
        console.log('Что-то пошло не так c получением контактов');
        console.log(data);
        return false;
    });
    page++;
}

company = function(data) {
    if (!!data) {
        contacts = data._embedded.contacts;
        for(i = 0; i < contacts.length; i++) {
            if(contacts[i]._embedded.leads.length < 1) {
                arr.push(contacts[i]);
            }  
        }
    } else {
        console.log('Контактов нет');
        return false;
    }
    //console.log(arr);
}

task = function(data) {
    if (!!data) {
        tasks = data._embedded.tasks;
        for(i = 0; i < arr.length; i++) {
            id = arr[i].account_id;
            const jsonTask = '{"text": "Контакт без сделок","complete_till": 1588885140,"entity_id": ' + id + ',"entity_type": "leads"}';
            const jsonParseTask = JSON.parse(jsonTask);
            tasks.push(jsonParseTask);
        }
    } else {
        console.log('Задач нет');
        return false;
    }
    console.log(tasks);
}

sendAjax('contacts.json', 'GET', company, 'leads');
sendAjax('tasks.json', 'POST', task, '');
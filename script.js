console.log("Script wurde aufgerufen !");

document.getElementById('get-btn-shifts').addEventListener('click', function() {
    // alert('BUTTON CLICK !');
    console.clear();
    console.log("BITTE WARTEN ...");
    callGetShifts();
});
document.getElementById('get-btn-tags').addEventListener('click', function() {
    // alert('BUTTON CLICK !');
    console.clear();
    console.log("BITTE WARTEN ...");
    callGetTags();
});
document.getElementById('get-btn-users').addEventListener('click', function() {
    // alert('BUTTON CLICK !');
    console.clear();
    console.log("BITTE WARTEN ...");
    callGetUsers();
});
document.getElementById('get-btn-userById').addEventListener('click', function() {
    // alert('BUTTON CLICK !');
    console.clear();
    console.log("BITTE WARTEN ...");
    callGetUserById();
});
document.getElementById('get-btn-workingAreas').addEventListener('click', function() {
    // alert('BUTTON CLICK !');
    console.clear();
    console.log("BITTE WARTEN ...");
    callGetWorkingAreas();
});
document.getElementById('get-btn-locations').addEventListener('click', function() {
    // alert('BUTTON CLICK !');
    console.clear();
    console.log("BITTE WARTEN ...");
    callGetLocations();
});
document.getElementById('set-btn-User').addEventListener('click', function() {
    // alert('BUTTON CLICK !');
    console.clear();
    console.log("BITTE WARTEN ...");
    callSetUser();
});
document.getElementById('set-btn-Shift').addEventListener('click', function() {
    // alert('BUTTON CLICK !');
    console.clear();
    console.log("BITTE WARTEN ...");
    callSetShift();
});
document.getElementById('set-btn-Absen').addEventListener('click', function() {
    // alert('BUTTON CLICK !');
    console.clear();
    console.log("BITTE WARTEN ...");
    callSetAbsence();
});
document.getElementById('set-btn-Tag').addEventListener('click', function() {
    // alert('BUTTON CLICK !');
    console.clear();
    console.log("BITTE WARTEN ...");
    callSetTag();
});

// function createIframe() {
//     var iframe = document.createElement("iframe");
//     iframe.src = "form.html";
//     iframe.width = "600";
//     iframe.height = "400";
//     document.body.appendChild(iframe);
//   }

function callGetShifts() {
    // Auslesen der Werte aus den Input-Feldern
    let api_token = "uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp";
    let location_id = document.getElementById('location_id').value;
    let range_start = document.getElementById('range_start').value;
    let range_end = document.getElementById('range_end').value;

    // Erstellen des URL-encodierten Strings für den Body
    let bodyContent = new URLSearchParams({
        'action': 'getShiftsFromPapershift',
        'api_token': api_token,
        'location_id': location_id,
        'range_start': range_start,
        'range_end': range_end
    }).toString();

    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: bodyContent
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Hier können Sie mit der Antwort arbeiten
        // Zum Beispiel: document.getElementById('result').innerHTML = data;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
function callGetTags() {
    let api_token = "uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp";
    let location_id = document.getElementById('location_id').value;

    // Erstellen des URL-encodierten Strings für den Body
    let bodyContent = new URLSearchParams({
        'action': 'getTagsFromPapershift',
        'api_token': api_token,
        'location_id': location_id
    }).toString();

    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: bodyContent
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Hier können Sie mit der Antwort arbeiten
        // Zum Beispiel: document.getElementById('result').innerHTML = data;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
function callGetUsers() {
    let api_token = "uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp";

    // Erstellen des URL-encodierten Strings für den Body
    let bodyContent = new URLSearchParams({
        'action': 'getUsersFromPapershift',
        'api_token': api_token
    }).toString();

    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: bodyContent
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Hier können Sie mit der Antwort arbeiten
        // Zum Beispiel: document.getElementById('result').innerHTML = data;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
function callGetUserById() {
    // Auslesen der Werte aus den Input-Feldern
    let api_token = "uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp";
    let id = document.getElementById('user_id').value;

    // Erstellen des URL-encodierten Strings für den Body
    let bodyContent = new URLSearchParams({
        'action': 'getUserByIdFromPapershift',
        'api_token': api_token,
        'id': id
    }).toString();

    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: bodyContent
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Hier können Sie mit der Antwort arbeiten
        // Zum Beispiel: document.getElementById('result').innerHTML = data;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
function callGetWorkingAreas() {
        // Auslesen der Werte aus den Input-Feldern
        let api_token = "uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp";
        let location_id = document.getElementById('location_id').value;
    
        // Erstellen des URL-encodierten Strings für den Body
        let bodyContent = new URLSearchParams({
            'action': 'getWorkingAreasFromPapershift',
            'api_token': api_token,
            'location_id': location_id
        }).toString();
    
        fetch('index.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: bodyContent
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Hier können Sie mit der Antwort arbeiten
            // Zum Beispiel: document.getElementById('result').innerHTML = data;
        })
        .catch((error) => {
            console.error('Error:', error);
        });    
}
function callGetLocations() {
    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=getLocationsFromPapershift'
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Hier können Sie mit der Antwort arbeiten
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
function callSetUser() {
    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=setUserInPapershift'
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Hier können Sie mit der Antwort arbeiten
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
function callSetShift() {
            // Auslesen der Werte aus den Input-Feldern
            let api_token = "uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp";
            let location_id = document.getElementById('location_id').value;
            let working_area_id = document.getElementById('working_area_id').value;
            let starts_at = document.getElementById('starts_at').value;
            let ends_at = document.getElementById('ends_at').value;
            let number_of_employees = document.getElementById('number_of_employees').value;
        
            // Erstellen des URL-encodierten Strings für den Body
            let bodyContent = new URLSearchParams({
                'action': 'setShiftInPapershift',
                'api_token': api_token,
                'location_id': location_id,
                'working_area_id': working_area_id,
                'starts_at': starts_at,
                'ends_at': ends_at,
                'number_of_employees': number_of_employees
            }).toString();
        
            fetch('index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: bodyContent
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Hier können Sie mit der Antwort arbeiten
                // Zum Beispiel: document.getElementById('result').innerHTML = data;
            })
            .catch((error) => {
                console.error('Error:', error);
            });    
}
function callSetAbsence() {
    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=setUserabsenceInPapershift'
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Hier können Sie mit der Antwort arbeiten
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
function callSetTag() {
    // Auslesen der Werte aus den Input-Feldern
    let api_token = "uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp";
    let location_id = document.getElementById('location_id').value;
    let title = document.getElementById('title').value;

    // Erstellen des URL-encodierten Strings für den Body
    let bodyContent = new URLSearchParams({
        'action': 'setTagInPapershift',
        'api_token': api_token,
        'location_id': location_id,
        'title': title
    }).toString();

    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: bodyContent
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Hier können Sie mit der Antwort arbeiten
        // Zum Beispiel: document.getElementById('result').innerHTML = data;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

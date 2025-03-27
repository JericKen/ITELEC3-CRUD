document.addEventListener('DOMContentLoaded', renderData);

let isInserting = true;

async function getData() {
    try {
        const response = await fetch('/about/contents');

        const data = await response.json();
        console.log(data);

        if (data.success) {
            return data.content;
        }
    } catch (error) {
        console.error(error);
    }
}

async function renderData() {
    const contents = await getData();

    const tbody = document.getElementById('tbody');
    tbody.innerHTML = '';

    contents.forEach(content => {
        const tr = document.createElement('tr');

        const idCell = document.createElement('td');
        const titleCell = document.createElement('td');
        const contentCell = document.createElement('td');

        idCell.textContent = content.id;
        titleCell.textContent = content.title;
        contentCell.textContent = content.content;

        tr.append(idCell, titleCell, contentCell, actionButton(content));
        tbody.appendChild(tr);
    });
}

async function insertData() {
    const title = document.getElementById('title').value;
    const content = document.getElementById('content').value;

    if (title.trim() === '' || content.trim() === '') return;

    try {
        const response = await fetch('/about/contents/add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title, content })
        });

        const data = await response.json();

        if (data.success) {
            renderData();
            document.getElementById('formData').reset();
        }
    } catch (error) {
        console.error(error);   
    }
}

async function updateData() {
    const title = document.getElementById('title').value;
    const content = document.getElementById('content').value;
    const id = document.getElementById('id').value;

    if (title.trim() === '' || content.trim() === '') return;

    try {
        const response = await fetch('/about/contents/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title, content, id })
        });

        const data = await response.json();

        if (data.success) {
            renderData();
            document.getElementById('formData').reset();
        }
    } catch (error) {
        console.error(error);   
    }
}

function actionButton(content) {
    const td = document.createElement('td');
    const buttonGroup = document.createElement('div');

    const editButton = document.createElement('button');
    const deleteButton = document.createElement('button');

    editButton.textContent = 'Edit';
    deleteButton.textContent = 'Delete';

    buttonGroup.classList.add('d-flex', 'gap-3');
    editButton.classList.add('btn', 'bg-primary-subtle', 'text-primary', 'btn-sm', 'w-100');
    deleteButton.classList.add('btn', 'bg-danger-subtle', 'text-danger', 'btn-sm', 'w-100');

    buttonGroup.append(editButton, deleteButton);
    td.appendChild(buttonGroup);

    editButton.addEventListener('click', async () => {
        isInserting = false;
        document.getElementById('id').value = content.id;

        try {
            const response = await fetch('/about/contents/get', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: content.id })
            });
    
            const data = await response.json(); 

            document.getElementById('title').value = data.row.title;
            document.getElementById('content').value = data.row.content;
        } catch (error) {
            console.error(error);
        }


        document.getElementById('nav-data-entry-tab').click();
    });

    deleteButton.addEventListener('click', async () => {
        try {
            const response = await fetch('/about/contents/delete', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: content.id })
            });
    
            const data = await response.json(); 
            
            if (data.success) renderData();
        } catch (error) {
            console.error(error);
        }
    })

    return td;
}

document.getElementById('formData').addEventListener('submit', (e) => {
    e.preventDefault();

    if (isInserting) {
        insertData();
    } else {
        updateData();
        isInserting = true;
    }

    document.getElementById('nav-data-tab').click();
})
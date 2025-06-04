function sumar() {
    var numero1 = document.getElementById("numero1").value;
    var numero2 = document.getElementById("numero2").value;
    var suma = parseInt(numero1) * parseInt(numero2);
    return suma;

}

function mostrarResultado() {
    var resultadoInput = document.getElementById("resultado");
    resultadoInput.value = sumar();
}

function alerta () {
    alert("NO HAY PROMOCIONES DISPONIBLES");
  }

function regresar() {
    window.location.href = "index.php";
}

function mostraralerta() {
    alert("EN MANTENIMIENTO 😞😞😞" );
}

//mostrar datos prueba para el panel de Administrador
// Sample client data
const clientData = [
    { id: 1, name: 'Jane Cooper', paquete: 'Maras', phone: '(555) 555-0118', email: 'jane@microsoft.com', location: 'Cusco', status: 'active' },
    { id: 2, name: 'Floyd Miles', paquete: 'Machupicchu', phone: '(205) 555-0100', email: 'floyd@yahoo.com', location: 'Washingq', status: 'pending' },
    { id: 3, name: 'Ronald Richards', paquete: 'M. 7 colores', phone: '(302) 555-0107', email: 'ronald@adobe.com', location: 'San Sebastian', status: 'inactive' },
    { id: 4, name: 'Marvin McKinney', paquete: 'Maras', phone: '(252) 555-0126', email: 'marvin@tesla.com', location: 'Washingq', status: 'inactive' },
    { id: 5, name: 'Jerome Bell', paquete: 'Machupicchu', phone: '(629) 555-0129', email: 'jerome@google.com', location: 'San Jeronimo', status: 'active' },
    { id: 6, name: 'Kathryn Murphy', paquete: 'Machupicchu', phone: '(406) 555-0120', email: 'kathryn@microsoft.com', location: 'Saylla', status: 'active' },
    { id: 7, name: 'Jacob Jones', paquete: 'Machupicchu', phone: '(208) 555-0112', email: 'jacob@yahoo.com', location: 'Parry', status: 'inactive' },
    { id: 8, name: 'Kristin Watson', paquete: 'Maras', phone: '(704) 555-0127', email: 'kristin@facebook.com', location: 'Washingq', status: 'pending' },
];

// State management
let currentPage = 1;
const itemsPerPage = 5;
let filteredClients = [...clientData];

// DOM Elements
const clientsTableBody = document.getElementById('clientsTableBody');
const paginationContainer = document.getElementById('pagination');
const clientSearch = document.querySelector('.client-search');
const menuToggle = document.getElementById('menuToggle');
const sidebar = document.querySelector('.sidebar');

// Toggle sidebar on mobile
menuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

// Search functionality
clientSearch.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    filteredClients = clientData.filter(client => 
        client.name.toLowerCase().includes(searchTerm) ||
        client.paquete.toLowerCase().includes(searchTerm) ||
        client.email.toLowerCase().includes(searchTerm)
    );
    currentPage = 1;
    renderTable();
    renderPagination();
});

// Get status badge class
function getStatusBadgeClass(status) {
    switch(status) {
        case 'active':
            return 'bg-success';
        case 'pending':
            return 'bg-warning';
        case 'inactive':
            return 'bg-danger';
        default:
            return 'bg-secondary';
    }
}

// Render table function
function renderTable() {
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedClients = filteredClients.slice(start, end);

    clientsTableBody.innerHTML = paginatedClients.map(client => `
        <tr>
            <td>${client.name}</td>
            <td>${client.paquete}</td>
            <td>${client.phone}</td>
            <td>${client.email}</td>
            <td>${client.location}</td>
            <td>
                <span class="badge rounded-pill ${getStatusBadgeClass(client.status)} bg-opacity-10 text-${client.status === 'active' ? 'success' : client.status === 'pending' ? 'warning' : 'danger'}">
                    ${client.status.charAt(0).toUpperCase() + client.status.slice(1)}
                </span>
            </td>
        </tr>
    `).join('');
}

// Render pagination function
function renderPagination() {
    const totalPages = Math.ceil(filteredClients.length / itemsPerPage);
    
    let paginationHTML = `
        <nav class="d-flex justify-content-center">
            <ul class="pagination mb-0">
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <button class="page-link" onclick="changePage(${currentPage - 1})">Previous</button>
                </li>
    `;

    for (let i = 1; i <= totalPages; i++) {
        paginationHTML += `
            <li class="page-item ${currentPage === i ? 'active' : ''}">
                <button class="page-link" onclick="changePage(${i})">${i}</button>
            </li>
        `;
    }

    paginationHTML += `
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <button class="page-link" onclick="changePage(${currentPage + 1})">Next</button>
                </li>
            </ul>
        </nav>
    `;

    paginationContainer.innerHTML = paginationHTML;
}

// Change page function
function changePage(page) {
    const totalPages = Math.ceil(filteredClients.length / itemsPerPage);
    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        renderTable();
        renderPagination();
    }
}

// Initial render
renderTable();
renderPagination();

// Handle window resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('active');
    }
});


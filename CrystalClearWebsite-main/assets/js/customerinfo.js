var url = 'assets/php/customerDB.php';

function initCustomerInfo() {
    GetCustomerInfoDB();
}

// Database fetch requests
function GetCustomerInfoDB()
{
    //Send request to PHP backend. Tells db to return all services in a JSON file
    var formDataAllCustomers = new FormData();
    formDataAllCustomers.set('var1', 'getAllCustomers');

    fetch(url, {
        method: 'POST',
        body: formDataAllCustomers
    })
    .then(res => res.json())
    .then(res => getAllCustomers(res))
    .catch(e => console.error('Error, getAllCustomers(), ' + e))
}

//  Get function
function getAllCustomers(response) {
    console.log(response);

    for(i=0; i<response.results.length; i++)
    {
        let ID = '' + Object.values(response.results)[i].SERVICE_ID;
        let name = '' + Object.values(response.results)[i].serviceName;
        let description = '' + Object.values(response.results)[i].serviceDescription;
        let price = '' + Object.values(response.results)[i].servicePrice;

        addServiceCard(ID, name, description, price);
    }
}
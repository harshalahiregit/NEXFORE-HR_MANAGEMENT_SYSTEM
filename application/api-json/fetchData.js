const axios = require('axios');
const fs = require('fs');

axios.get('https://jsonplaceholder.typicode.com/posts')
  .then(response => {
    fs.writeFileSync('data.json', JSON.stringify(response.data, null, 2));
    console.log('Data saved to data.json');
  })
  .catch(error => {
    console.error(error);
  });

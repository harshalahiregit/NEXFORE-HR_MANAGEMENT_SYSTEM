const axios = require('axios');
const fs = require('fs');

axios.get('https://jsonplaceholder.typicode.com/posts')
  .then(response => {
    fs.writeFileSync('posts.json', JSON.stringify(response.data, null, 2));
    console.log('JSON data saved successfully!');
  })
  .catch(error => {
    console.error('Error:', error.message);
  });

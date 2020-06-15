const express = require('express')
const app = express()
const port = 3000

// Look for the root/default route.  If requested return 'Hello World!'
app.get('/', (req, res) => res.send('Hello World!'))

// Where are app is listening.  As you notice it will console.log the message on startup
app.listen(port, () => console.log(`Example app listening at http://localhost:${port}`))
import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';
import { BrowserRouter as Router } from 'react-router-dom';
import RouterComponent from './components/RouterComponent';

function App() {
  return (
    <Router>
      <div className="App">
        <RouterComponent />
      </div>
    </Router>
  );
}

export default App;

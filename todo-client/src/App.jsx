// import { useState } from 'react'
// import reactLogo from './assets/react.svg'
// import viteLogo from '/vite.svg'
// import './App.css'

// function App() {
  
//   return (
//     <>
//       <div>
//           <h1 class="text-3xl font-bold underline">Hello world!</h1>
//       </div>
//     </>
//   )
// }

// export default App
import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom'; 
import './App.css';
import Dashboard from './pages/Dashboard';
import LoginForm from './pages/login';
import RegisterForm from './pages/register';
import PrivateRoute from './pages/PrivateRoute';
const App = () => { 
  return ( 
    <Router> 
      <Routes> 
        <Route path="/" element={<LoginForm/>} />
        <Route path="/login" element={<LoginForm/>} />
        <Route path="/register" element={<RegisterForm/>} />
         
        <Route path="/dashboard" element={
          <PrivateRoute>
            <Dashboard/>
          </PrivateRoute>
        } /> 
         
        
      </Routes> 
    </Router> 
  );
};

export default App;
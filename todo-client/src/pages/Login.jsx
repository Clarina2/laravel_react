import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import api from "../api/axios";

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');

    // try {
    //     const 
    //     //  // Validation simple
    //     // if (!email || !password) {
    //     //     setError('Veuillez remplir tous les champs');
    //     //     return;
    //     // }
        
    //     // // Ici, vous ajouteriez la logique d'authentification
    //     // console.log('Email:', email, 'Password:', password);
        
    //     // // Après une authentification réussie :
    //     // navigate('/dashboard');
    //     // }
    // } catch (error) {
    //   console.error('Erreur lors de la connexion:', error);
    //   setError('Erreur lors de la connexion. Veuillez réessayer.');
        
    // }
    try {
        const response = await api.post("/login", { email, password });
  
        // Stocker le token
        localStorage.setItem("token", response.data.access_token);
  
        // Rediriger vers le dashboard ou autre
        navigate("/dashboard");
      } catch (error) {
        console.error(error);
        alert("Échec de la connexion");
      }
    };
    
   

  return (
    <div className="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md mt-20">
      <h2 className="text-2xl font-bold text-center text-gray-800 mb-6">Connexion</h2>
      
      {error && (
        <div className="mb-4 p-2 bg-red-100 text-red-700 rounded">
          {error}
        </div>
      )}
      
      <form onSubmit={handleSubmit}>
        <div className="mb-4">
          <label htmlFor="email" className="block text-gray-700 mb-2">
            Email
          </label>
          <input
            type="email"
            id="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="votre@email.com"
          />
        </div>
        
        <div className="mb-6">
          <label htmlFor="password" className="block text-gray-700 mb-2">
            Mot de passe
          </label>
          <input
            type="password"
            id="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="••••••••"
          />
        </div>
        
        <button
          type="submit"
          className="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
          Se connecter
        </button>
      </form>
      
      <div className="mt-4 text-center">
        <p className="text-gray-600">
          Pas encore de compte ?{' '}
          <Link to="/register" className="text-blue-600 hover:underline">
            S'inscrire
          </Link>
        </p>
      </div>
    </div>
  );
};

export default Login;
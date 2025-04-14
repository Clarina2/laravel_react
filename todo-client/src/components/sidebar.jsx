const handleLogout = async () => {
    try {
      await fetch('http://localhost:8000/api/logout', {
        method: 'POST',
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });
  
      localStorage.removeItem('token'); // supprime le token stocké
      window.location.href = '/login';  // redirige vers la page de login
    } catch (error) {
      console.error('Erreur de déconnexion :', error);
    }
  };
  
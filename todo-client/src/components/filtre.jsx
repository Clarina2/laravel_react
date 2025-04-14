import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function TacheList() {
  const [taches, setTaches] = useState([]);
  const [filter, setFilter] = useState('all');

  useEffect(() => {
    axios.get('http://127.0.0.1:8000/api/taches', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      }
    })
    .then(response => setTaches(response.data))
    .catch(error => console.error(error));
  }, []);

  const filteredTaches = taches.filter(t => {
    if (filter === 'completed') return t.completed;
    if (filter === 'incomplete') return !t.completed;
    return true;
  });

  return (
    <div>
      <h2>Mes Tâches</h2>
      <div style={{ marginBottom: '1rem' }}>
        <button onClick={() => setFilter('all')}>Toutes</button>
        <button onClick={() => setFilter('completed')}>Terminées ✅</button>
        <button onClick={() => setFilter('incomplete')}>Non terminées ❌</button>
      </div>
      <ul>
        {filteredTaches.map(tache => (
          <li key={tache.id}>
            <span style={{ textDecoration: tache.completed ? 'line-through' : 'none' }}>
              {tache.title}
            </span>
          </li>
        ))}
      </ul>
    </div>
  );
}

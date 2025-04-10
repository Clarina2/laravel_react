

const Dashboard = () => {
    return (
      <div>
        <h1 className="text-3xl font-bold text-gray-800 mb-6">Tableau de bord</h1>
        
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {/* Card 1 */}
          <div className="bg-white p-6 rounded-lg shadow-md">
            <h2 className="text-xl font-semibold text-gray-700 mb-2">Statistique 1</h2>
            <p className="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <div className="mt-4 text-blue-600 font-medium">Voir plus →</div>
          </div>
          
          {/* Card 2 */}
          <div className="bg-white p-6 rounded-lg shadow-md">
            <h2 className="text-xl font-semibold text-gray-700 mb-2">Statistique 2</h2>
            <p className="text-gray-600">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <div className="mt-4 text-blue-600 font-medium">Voir plus →</div>
          </div>
          
          {/* Card 3 */}
          <div className="bg-white p-6 rounded-lg shadow-md">
            <h2 className="text-xl font-semibold text-gray-700 mb-2">Statistique 3</h2>
            <p className="text-gray-600">Ut enim ad minim veniam, quis nostrud exercitation.</p>
            <div className="mt-4 text-blue-600 font-medium">Voir plus →</div>
          </div>
        </div>
        
        <div className="mt-8 bg-white p-6 rounded-lg shadow-md">
          <h2 className="text-xl font-semibold text-gray-700 mb-4">Activité récente</h2>
          <div className="space-y-4">
            <div className="border-b pb-4">
              <p className="text-gray-800">Nouvel utilisateur inscrit</p>
              <p className="text-sm text-gray-500">Il y a 2 heures</p>
            </div>
            <div className="border-b pb-4">
              <p className="text-gray-800">Mise à jour du système</p>
              <p className="text-sm text-gray-500">Hier à 14:30</p>
            </div>
            <div>
              <p className="text-gray-800">Nouvelle fonctionnalité ajoutée</p>
              <p className="text-sm text-gray-500">3 jours ago</p>
            </div>
          </div>
        </div>
      </div>
    );
};
  
export default Dashboard;
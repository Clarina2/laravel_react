import React from 'react';
import api from '../api/axios';

const fetchTasks = async () => {
  try {
    const response = await api.get('/taches');
    setTasks(response.data);
  } catch (error) {
    // Gestion des erreurs
  }
};
const TaskItem = ({ task, onEdit, onDelete, onToggle }) => {
    if (!task || typeof task !== 'object') {
        return null; // Retourne rien si `task` est invalide
    }
    return (
        <div className="bg-white p-5 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition flex justify-between items-start gap-4">
        <div className="flex items-start flex-1">
            {/* Checkbox pour marquer la tâche comme terminée */}
            <input
            type="checkbox"
            checked={task.completed !== undefined ? task.completed : false}
            onChange={() => onToggle(task.id)}
            className="mr-3 mt-1 h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
            />
            <div className="flex-1">
            <h3 className={`text-lg font-semibold ${task.completed ? 'text-gray-500 line-through' : 'text-gray-900'} mb-1`}>
                {task.title}
            </h3>
            {task.description && (
                <p className={`text-sm ${task.completed ? 'text-gray-400' : 'text-gray-600'} whitespace-pre-line`}>
                {task.description}
                </p>
            )}
            </div>
        </div>

        <div className="flex flex-col sm:flex-row gap-2 items-end sm:items-center">
            <button
            onClick={() => onEdit(task)}
            className="px-4 py-1.5 bg-blue-100 text-blue-700 font-medium rounded-lg hover:bg-blue-200 transition text-sm"
            >
            Modifier
            </button>
            <button
            onClick={() => onDelete(task.id)}
            className="px-4 py-1.5 bg-red-100 text-red-600 font-medium rounded-lg hover:bg-red-200 transition text-sm"
            >
            Supprimer
            </button>
        </div>
        </div>
    );
};

export default TaskItem;

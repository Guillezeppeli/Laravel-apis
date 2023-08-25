import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './RecipeUpload.css';
import { useNavigate } from 'react-router-dom';

function RecipeUpload() {
  const [title, setTitle] = useState('');
  const [description, setDescription] = useState('');
  const [ingredients, setIngredients] = useState('');
  const [preparation_steps, setPreparation_steps] = useState('');
  const [cooking_time, setCooking_time] = useState('');
  const [categories, setCategories] = useState([]);
  const [selectedCategoryId, setSelectedCategoryId] = useState('');
  const [image, setImage] = useState(null);
  const navigate = useNavigate();
  const handleGoBack = () => {
    navigate('/');
  };

  // Fetching categories using useEffect
  useEffect(() => {
    axios.get('http://localhost:8000/api/categories')
        .then(response => {
            setCategories(response.data);
        })
        .catch(error => {
            console.error("Error fetching categories:", error);
        });
}, []);

  const handleSubmit = (e) => {
    e.preventDefault();

    const formData = new FormData();
    formData.append('title', title);
    formData.append('description', description);
    formData.append('ingredients', ingredients);
    formData.append('preparation_steps', preparation_steps);
    formData.append('cooking_time', cooking_time);
    formData.append('category_id', selectedCategoryId);
    if (image) formData.append('image', image);

    axios.post('http://localhost:8000/api/recipes', formData)
        .then(response => {
            console.log("Recipe uploaded successfully:", response.data);
        })
        .catch(error => {
            console.error("Error uploading the recipe:", error);
        });
  };

  return (
    <div>
        <h2>Upload Recipe</h2>
        <form onSubmit={handleSubmit}>
            <div>
                <label>Title:</label>
                <input type="text" value={title} onChange={e => setTitle(e.target.value)} required />
            </div>
            <div>
                <label>Description:</label>
                <textarea value={description} onChange={e => setDescription(e.target.value)} required></textarea>
            </div>
            <div>
                <label>Ingredients:</label>
                <textarea value={ingredients} onChange={e => setIngredients(e.target.value)} required></textarea>
            </div>
            <div>
                <label>Preparation_steps:</label>
                <textarea value={preparation_steps} onChange={e => setPreparation_steps(e.target.value)} required></textarea>
            </div>
            <div>
                <label>Cooking_time:</label>
                <textarea value={cooking_time} onChange={e => setCooking_time(e.target.value)} required></textarea>
            </div>
            <div>
              <label>Category:</label>
              <select value={selectedCategoryId} onChange={e => setSelectedCategoryId(e.target.value)} required>
                  <option value="">Select a category</option>
                  {categories.map(category => (
                      <option key={category.id} value={category.id}>
                          {category.name}
                      </option>
                  ))}
              </select>
          </div>
            <div>
                <label>Image:</label>
                <input type="file" onChange={e => setImage(e.target.files[0])} />
            </div>
            <button type="submit">Upload Recipe</button>
            <button className='go-back' onClick={handleGoBack}>Go Back</button>
        </form>
    </div>
);
}

export default RecipeUpload;

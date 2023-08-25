import React, { useState, useEffect } from 'react';
import './RecipeDetail.css';
import axios from 'axios';
import { useParams, useNavigate } from 'react-router-dom';

function RecipeDetail() {
  const [recipe, setRecipe] = useState({});
  const [isLoading, setIsLoading] = useState(true);
  const [isEditing, setIsEditing] = useState(false);
  const [title, setTitle] = useState('');
  const [description, setDescription] = useState('');
  const [ingredients, setIngredients] = useState('');
  const [preparation_steps, setPreparation_steps] = useState('');
  const [cooking_time, setCooking_time] = useState('');
  const [categories, setCategories] = useState([]);
  const [selectedCategoryId, setSelectedCategoryId] = useState('');
  const [image, setImage] = useState(null);
  
  // Using useParams to get the recipe ID from the URL
  const { id } = useParams();
  const recipeId = useParams().id;
  const navigate = useNavigate();
  const handleGoBack = () => {
    navigate('/');
  };

  useEffect(() => {
    if (recipe && Object.keys(recipe).length) {
        setTitle(recipe.title);
        setDescription(recipe.description);
        setIngredients(recipe.ingredients);
        setPreparation_steps(recipe.preparation_steps);
        setCooking_time(recipe.cooking_time);
        setSelectedCategoryId(recipe.category_id);
    }
}, [recipe]);

  useEffect(() => {
    axios.get('http://localhost:8000/api/categories')
        .then(response => {
            setCategories(response.data);
        })
        .catch(error => {
            console.error("Error fetching categories:", error);
        });
}, []);

  useEffect(() => {
      // Fetching the recipe details using the id
      axios.get(`http://localhost:8000/api/recipes/${id}`)
          .then(response => {
              setRecipe(response.data);
              setIsLoading(false);
          })
          .catch(error => {
              console.error("There was an error fetching the recipe details", error);
          });
  }, [id]);  // Dependency array to ensure re-fetch if id changes

  if (isLoading) {
      return <div>Loading...</div>;
  }

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
      
      /*
      for (let pair of formData.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    */
   
    axios.post(`http://localhost:8000/api/recipes/${recipeId}?_method=PUT`, formData)
          .then(response => {
              console.log("Recipe updated successfully:", response.data);
              // You might want to refresh the data or navigate the user to another page
          })
          .catch(error => {
              console.error("Error updating the recipe:", error.response.data.errors);
          });
  };
  

  const handleDelete = () => {
    if (window.confirm("Are you sure you want to delete this recipe?")) {
      axios.delete(`http://localhost:8000/api/recipes/${recipeId}`)
          .then(response => {
              console.log("Recipe deleted successfully:", response.data);
              navigate('/');
          })
          .catch(error => {
              console.error("Error deleting the recipe:", error);
          });
    }
};
  
//console.log(title, description, ingredients, preparation_steps, cooking_time, selectedCategoryId);

  return (
    <div className="recipe-detail">
      {isEditing ? (
          // JSX for editing mode
        <>
          <form onSubmit={handleSubmit} encType="multipart/form-data">
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
                  <input type="text" value={ingredients} onChange={e => setIngredients(e.target.value)} required />
              </div>
              <div>
                  <label>Preparation Steps:</label>
                  <input type="text" value={preparation_steps} onChange={e => setPreparation_steps(e.target.value)} required />
              </div>
              <div>
                  <label>Cooking Time:</label>
                  <input type="text" value={cooking_time} onChange={e => setCooking_time(e.target.value)} required />
              </div>
              <div>
                  <label>Category:</label>
                  <select value={selectedCategoryId} onChange={e => setSelectedCategoryId(e.target.value)}>
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
              <button  className='update-edit' type="submit">Update Recipe</button>
          </form>
        </>
    ) : (
        // JSX for display mode
      <>
          <h2>{recipe.title}</h2>
          <img src={`http://localhost:8000/storage/${recipe.image}`} alt={recipe.title} width="300" />
          <div className="description">
              <p>{recipe.description}</p>
          </div>
          <div className="ingredients">
              <p>{recipe.ingredients}</p>
          </div>
          <div className="Preparation steps">
            <p>{recipe.preparation_steps}</p>
          </div>
          {/* Optionally add comments or other interactive features here */}
          <button onClick={() => setIsEditing(true)}>Edit Recipe</button>
          <button onClick={handleDelete}>Delete Recipe</button>
          <button onClick={handleGoBack}>Go Back</button>
      </>
  )}            
  </div>
  );
}

export default RecipeDetail;


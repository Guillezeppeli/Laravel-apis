import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './RecipeList.css';
import { Link } from 'react-router-dom';

function RecipeList() {
  const [recipes, setRecipes] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
      // Fetch recipes from the Laravel API
		axios.get('http://localhost:8000/api/recipes')
				.then(response => {
						setRecipes(response.data);
						setLoading(false);
				})
				.catch(err => {
						console.error("Error fetching recipes:", err);
						setError("There was an error loading recipes.");
						setLoading(false);
				});
  }, []);

  if (loading) return <p>Loading...</p>;
  if (error) return <p>{error}</p>;

  return (
    <div className="container">
    <h2 className="title">Recipes</h2>
    <ul style={{ listStyle: 'none', padding: 0 }}>
        {recipes.map(recipe => (
        <li key={recipe.id} className="recipe-item">
            <Link to={`/recipe/${recipe.id}`} className="recipe-link">
            <div>
                <img src={`http://localhost:8000/storage/${recipe.image}`} alt={recipe.title} className="recipe-image" />
                <span>{recipe.title}</span>
            </div>
            </Link>
        </li>
        ))}
    </ul>
    </div>
  );
}


export default RecipeList;

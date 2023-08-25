import React from 'react';
import { Route, Routes } from 'react-router-dom';
import DefaultLayout from './DefaultLayout.jsx';
import RecipeList from './RecipeList.jsx';
import RecipeDetail from './RecipeDetail.jsx';
import RecipeUpload from './RecipeUpload.jsx';

function RouterComponent() {
    return (
        <Routes>
          <Route path="/" element={
              <DefaultLayout>
                  <RecipeList />
              </DefaultLayout>
          } />
          <Route path="/recipe/:id" element={
              <DefaultLayout>
                  <RecipeDetail />
              </DefaultLayout>
          } />
          <Route path="/upload" element={
              <DefaultLayout>
                  <RecipeUpload />
              </DefaultLayout>
          } />
        </Routes>
    );
}

export default RouterComponent;

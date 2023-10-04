import React from 'react'
import ReactDOM from 'react-dom/client'
import CategoriesComponent from "./jsx/CategoriesComponent";

ReactDOM.createRoot(document.getElementById('react-app')).render(
    <React.StrictMode>
        <CategoriesComponent />
    </React.StrictMode>,
)
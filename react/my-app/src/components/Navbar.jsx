import React from 'react';
import './Navbar.css';
import { Link } from 'react-router-dom';

function Navbar() {
    return (
        <nav className="navbar">
            <div className="navbar-brand">
                {/* Assuming you might want to add a brand name or logo */}
                <Link to="/">CuisineBlog</Link>
            </div>
            <div className="navbar-links">
                <Link to="/upload">Upload Recipe</Link>
                {/* Add more links as needed */}
            </div>
        </nav>
    );
}

export default Navbar;

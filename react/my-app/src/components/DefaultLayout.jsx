import React from 'react';
import Navbar from './Navbar.jsx';

function DefaultLayout({ children }) {
    return (
        <div className="default-layout">
            <Navbar />
            <div className="content">
                {children}
            </div>
        </div>
    );
}

export default DefaultLayout;
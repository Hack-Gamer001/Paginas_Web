import React from 'react';
import './item-description.css'
import ColorModes from '../color-modes';
import { Link } from 'react-router-dom';


const ShopItem: React.FC = () => {
    return (
        <div className="container">
            {/* Simbolos para el boton de cambios ed texto */}
            <svg xmlns="http://www.w3.org/2000/svg" className="d-none">
                <symbol id="check2" viewBox="0 0 16 16">
                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </symbol>
                <symbol id="circle-half" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                </symbol>
                <symbol id="moon-stars-fill" viewBox="0 0 16 16">
                    <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                    <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
                </symbol>
                <symbol id="sun-fill" viewBox="0 0 16 16">
                    <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                </symbol>
                </svg>
                <ColorModes />
                <div className="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
                <button className="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
                        id="bd-theme"
                        type="button"
                        aria-expanded="false"
                        data-bs-toggle="dropdown"
                        aria-label="Toggle theme (auto)">
                    <svg className="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
                    <span className="visually-hidden" id="bd-theme-text">Toggle theme</span>
                </button>
                <ul className="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
                    <li>
                    <button type="button" className="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                        <svg className="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
                        Light
                        <svg className="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                    </button>
                    </li>
                    <li>
                    <button type="button" className="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                        <svg className="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
                        Dark
                        <svg className="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                    </button>
                    </li>
                    <li>
                    <button type="button" className="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                        <svg className="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
                        Auto
                        <svg className="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                    </button>
                    </li>
                </ul>
            </div>
            <header data-bs-theme="dark">
                <nav className="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                    <div className="container-fluid">
                        <a className="navbar-brand" href="#">IncaTech</a>
                        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span className="navbar-toggler-icon"></span>
                        </button>
                        <div className="collapse navbar-collapse" id="navbarCollapse">
                            <ul className="navbar-nav me-auto mb-2 mb-md-0">
                                <li className="nav-item">
                                <Link className="nav-link active" aria-current="page" to="/">Home</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link active" aria-current="page" to="/store">Store</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link active" aria-current="page" to="/brands">Brands</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link active" aria-current="page" to="/aboutus">About Us</Link>
                                </li>
                                <li className="nav-item">
                                    <a className="nav-link active" aria-current="page" href="https://wa.me/51918702530">Contact</a>
                                </li>
                            </ul>
                        <form className="d-flex" role="search">
                            <input className="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                            <button className="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <Link className="btn btn-sm btn-outline-secondary ms-2" to="/signin">Sign In</Link>
                        <a className="btn btn-sm btn-outline-secondary ms-2" href="#"><i className="bi bi-cart"></i> Cart</a>
                        </div>
                    </div>
                </nav>
            </header>
            {/* <!-- Product section--> */}
            <section className="py-5">
                <div className="container px-4 px-lg-5 my-5">
                    <div className="row gx-4 gx-lg-5 align-items-center">
                        <div className="col-md-6">
                            <svg className="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="600" height="700" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 600x700" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">600x700</text></svg>
                        </div>
                        <div className="col-md-6">
                            <div className="small mb-1">SKU: BST-498</div>
                            <h1 className="display-5 fw-bolder">Shop item template</h1>
                            <div className="fs-5 mb-5">
                                <span className="text-decoration-line-through">$45.00</span>
                                <span>$40.00</span>
                            </div>
                            <p className="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
                            <div className="d-flex">
                                <input 
                                    className="form-control text-center me-4" 
                                    id="inputQuantity" 
                                    type="number" 
                                    defaultValue="1" 
                                    min="0"
                                    max="5" 
                                    style={{ 
                                        maxWidth: '3rem', 
                                        backgroundColor: 'var(--input-bg)', 
                                        color: 'var(--input-color)' 
                                    }} 
                                />
                                <button className="btn btn-outline-primary flex-shrink-0" type="button">
                                    <i className="bi-cart-fill me-1"></i>Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {/* <!-- Related items section--> */}

            <div className="album py-5 bg-body-tertiary">
                    <div className="container px-4 px-lg-5 mt-5">
                        <h2 className="fw-bolder mb-4">Related Products</h2>
                        <div className="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                            {['Fancy Product', 'Special Item', 'Sale Item', 'Popular Item'].map((product, index) => (
                                <div className="col mb-5" key={index}>
                                    <div className="card shadow-sm h-100">
                                        <svg className="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <title>Placeholder</title>
                                            <rect width="100%" height="100%" fill="#55595c"/>
                                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">{index === 0 ? '450x300' : '450x300'}</text>
                                        </svg>
                                        <div className="card-body p-4">
                                            <div className="text-center">
                                                <h5 className="fw-bolder">{product}</h5>
                                                {product === 'Special Item' ? (
                                                    <>
                                                        <div className="d-flex justify-content-center small text-warning mb-2">
                                                            <div className="bi-star-fill"></div>
                                                            <div className="bi-star-fill"></div>
                                                            <div className="bi-star-fill"></div>
                                                            <div className="bi-star-fill"></div>
                                                            <div className="bi-star-fill"></div>
                                                        </div>
                                                        <span className="text-muted text-decoration-line-through">$20.00</span>
                                                        $18.00
                                                    </>
                                                ) : product === 'Sale Item' ? (
                                                    <>
                                                        <span className="text-muted text-decoration-line-through">$50.00</span>
                                                        $25.00
                                                    </>
                                                ) : (
                                                    <span>$40.00</span>
                                                )}
                                            </div>
                                        </div>
                                        <div className="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                            <div className="text-center">
                                                <a className="btn btn-outline-secondary mt-auto" href="#">View options</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

            {/* <!-- Footer--> */}
            <footer className="container">
                <p className="float-end"><a href="#">Back to top</a></p>
                <p>&copy; 2024 Company, Inc.</p>
            </footer>
        </div>
    );
}

export default ShopItem;
import { useEffect } from 'react';

const ColorModes = () => {
  // Recupera el tema almacenado en localStorage
  const getStoredTheme = (): string | null => localStorage.getItem('theme');

  // Almacena el tema seleccionado en localStorage
  const setStoredTheme = (theme: string): void => localStorage.setItem('theme', theme);

  // Obtiene el tema preferido según el sistema o el almacenado
  // eslint-disable-next-line react-hooks/exhaustive-deps
  const getPreferredTheme = (): string => {
    const storedTheme = getStoredTheme();
    if (storedTheme) return storedTheme;
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  };

  // Establece el tema (claro, oscuro o automático)
  const setTheme = (theme: string): void => {
    const themeToSet = theme === 'auto' ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light') : theme;
    document.documentElement.setAttribute('data-bs-theme', themeToSet);
  };

  // Muestra el tema activo en el UI (para los botones)
  const showActiveTheme = (theme: string, focus: boolean = false): void => {
    const themeSwitcher = document.querySelector<HTMLDivElement>('#bd-theme');
    if (!themeSwitcher) return;

    const themeSwitcherText = document.querySelector<HTMLElement>('#bd-theme-text');
    const activeThemeIcon = document.querySelector<SVGElement>('.theme-icon-active use');
    const btnToActive = document.querySelector<HTMLElement>(`[data-bs-theme-value="${theme}"]`);
    const svgOfActiveBtn = btnToActive?.querySelector<SVGElement>('svg use')?.getAttribute('href');

    document.querySelectorAll<HTMLElement>('[data-bs-theme-value]').forEach((element) => {
      element.classList.remove('active');
      element.setAttribute('aria-pressed', 'false');
    });

    btnToActive?.classList.add('active');
    btnToActive?.setAttribute('aria-pressed', 'true');
    if (svgOfActiveBtn) activeThemeIcon?.setAttribute('href', svgOfActiveBtn);

    const themeSwitcherLabel = `${themeSwitcherText?.textContent} (${btnToActive?.dataset.bsThemeValue})`;
    themeSwitcher.setAttribute('aria-label', themeSwitcherLabel);

    if (focus) themeSwitcher.focus();
  };

  // Evento para cambios en el sistema (modo claro/oscuro)
  useEffect(() => {
    const handleSystemThemeChange = () => {
      const storedTheme = getStoredTheme();
      if (storedTheme !== 'light' && storedTheme !== 'dark') {
        setTheme(getPreferredTheme());
      }
    };

    const systemThemeMedia = window.matchMedia('(prefers-color-scheme: dark)');
    systemThemeMedia.addEventListener('change', handleSystemThemeChange);

    // Al cargar la página, establece el tema preferido
    setTheme(getPreferredTheme());
    showActiveTheme(getPreferredTheme());

    // Asignar eventos a los botones
    const themeToggles = document.querySelectorAll<HTMLElement>('[data-bs-theme-value]');
    themeToggles.forEach((toggle) => {
      toggle.addEventListener('click', () => {
        const theme = toggle.getAttribute('data-bs-theme-value')!;
        setStoredTheme(theme);
        setTheme(theme);
        showActiveTheme(theme, true);
      });
    });

    // Cleanup del evento
    return () => {
      systemThemeMedia.removeEventListener('change', handleSystemThemeChange);
    };
  }, [getPreferredTheme]);

  return null; // Este componente no renderiza nada, solo maneja la lógica de los temas.
};

export default ColorModes;

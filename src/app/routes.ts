import { createHashRouter } from "react-router";
import { Layout } from "./components/Layout";
import { HomePage } from "./pages/HomePage";
import { CatalogPage } from "./pages/CatalogPage";
import { CarDetailPage } from "./pages/CarDetailPage";
import { OrderFormPage } from "./pages/OrderFormPage";
import { AboutPage } from "./pages/AboutPage";
import { CartPage } from "./pages/CartPage";
import { NotFoundPage } from "./pages/NotFoundPage";
import { StudentPage } from "./pages/StudentPage";
import { LabsPage } from "./pages/LabsPage";
import { FeedbackPage } from "./pages/FeedbackPage";

export const router = createHashRouter([
  {
    path: "/",
    Component: Layout,
    children: [
      { index: true, Component: HomePage },
      { path: "catalog", Component: CatalogPage },
      { path: "catalog/:id", Component: CarDetailPage },
      { path: "cart", Component: CartPage },
      { path: "about", Component: AboutPage },
      { path: "order", Component: OrderFormPage },
      { path: "student", Component: StudentPage },
      { path: "labs", Component: LabsPage },
      { path: "feedback", Component: FeedbackPage },
      { path: "*", Component: NotFoundPage },
    ],
  },
]);

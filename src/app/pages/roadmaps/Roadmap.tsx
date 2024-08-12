import { toAbsoluteUrl } from "../../../_metronic/helpers";
import { Content } from "../../../_metronic/layout/components/content";
import { KTIcon } from "../../../_metronic/helpers";
// import { Content } from "../../../../_metronic/layout/components/content";
import { Card4 } from "../../../_metronic/partials/content/cards/Card4";

export function Roadmap() {
  return (
    <Content>
      <div className="d-flex flex-wrap flex-stack mb-6">
        <h3 className="fw-bolder my-2">Top Roadmaps</h3>
      </div>

      <div className="row g-6 g-xl-9 mb-6 mb-xl-9">
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-5.png"
            title="Frontend"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/frontend.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-4.png"
            title="Backend"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/backend.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-6.png"
            title="Fullstack"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/full-stack.pdf"
          />
        </div>
      </div>

      <div className="row g-6 g-xl-9 mb-6 mb-xl-9">
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-4.png"
            title="DevOps"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/devops.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-5.png"
            title="API Desgin"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/api-design.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-6.png"
            title="QA"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/qa.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-5.png"
            title="Android"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/android.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-4.png"
            title="AI and Data Scientist"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/ai-data-scientist.pdf"
          />
        </div>
      </div>

      <div className="row g-6 g-xl-9 mb-6 mb-xl-9">
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-5.png"
            title="Flutter"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/flutter.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-4.png"
            title="React Native"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/react-native.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-6.png"
            title="GraphQL"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/graphql.pdf"
          />
        </div>
      </div>

      <div className="row g-6 g-xl-9 mb-6 mb-xl-9">
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-4.png"
            title="React"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/react.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-5.png"
            title="Vue"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/vue.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-6.png"
            title="Angular"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/angular.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-5.png"
            title="Typescript"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/typescript.pdf"
          />
        </div>
        <div className="col-12 col-sm-12 col-xl">
          <Card4
            icon="media/backgrounds/roadmap-4.png"
            title="ASP.NET Core"
            description=""
            link="https://roadmap.sh/pdfs/roadmaps/aspnet-core.pdf"
          />
        </div>
      </div>

      <div className="text-muted">
        You Could Access Roadmap Resource{" "}
        <a href="https://roadmap.sh/" target="_blank">
          From Here
        </a>
      </div>
    </Content>
  );
}

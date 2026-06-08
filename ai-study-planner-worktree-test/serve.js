const fs = require("node:fs");
const http = require("node:http");
const path = require("node:path");

const projectDir = __dirname;
const port = Number(process.argv[2] || process.env.PORT || 4173);

const contentTypes = {
  ".css": "text/css; charset=utf-8",
  ".html": "text/html; charset=utf-8",
  ".js": "text/javascript; charset=utf-8",
  ".json": "application/json; charset=utf-8",
  ".md": "text/markdown; charset=utf-8"
};

const server = http.createServer((request, response) => {
  const requestedPath = request.url === "/" ? "/index.html" : request.url;
  const safePath = path.normalize(decodeURIComponent(requestedPath)).replace(/^(\.\.[/\\])+/, "");
  const filePath = path.join(projectDir, safePath);
  const relativePath = path.relative(projectDir, filePath);

  if (relativePath.startsWith("..") || path.isAbsolute(relativePath)) {
    response.writeHead(403);
    response.end("Forbidden");
    return;
  }

  fs.readFile(filePath, (error, data) => {
    if (error) {
      response.writeHead(404);
      response.end("Not found");
      return;
    }

    const type = contentTypes[path.extname(filePath)] || "text/plain; charset=utf-8";
    response.writeHead(200, { "Content-Type": type });
    response.end(data);
  });
});

server.listen(port, "127.0.0.1", () => {
  console.log(`AI Study Planner bezi na http://127.0.0.1:${port}`);
  console.log("Server zastavis klavesovou zkratkou Ctrl+C.");
});

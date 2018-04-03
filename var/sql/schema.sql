DROP TABLE IF EXISTS isf;
CREATE TABLE IF NOT EXISTS isf (
    year INTEGER,
    region VARCHAR(255),
    department VARCHAR(255),
    insee CHAR(5),
    city VARCHAR(255),
    people INTEGER,
    tax_avg INTEGER,
    weatlh_avg INTEGER
);
CREATE INDEX IF NOT EXISTS isf_year ON isf (year);
CREATE INDEX IF NOT EXISTS isf_insee ON isf (insee);

DROP TABLE IF EXISTS position;
CREATE TABLE IF NOT EXISTS position (
    insee CHAR(5),
    lat VARCHAR(255),
    lon VARCHAR(255)
);
CREATE UNIQUE INDEX IF NOT EXISTS position_insee ON position (insee);

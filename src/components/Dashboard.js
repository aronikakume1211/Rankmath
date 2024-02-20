import axios from "axios";
import React, { useState, useEffect } from "react";
import { I18nextProvider } from "react-i18next";
import i18n from "./i18n";
import { useTranslation } from "react-i18next";
import {
  CartesianGrid,
  Line,
  LineChart,
  Tooltip,
  XAxis,
  YAxis,
} from "recharts";

const Dashboard = () => {
  const [posts, setPosts] = useState([]);
  const [value, setValue] = useState(7); // default value is 7 days
  const { t } = useTranslation(); // get the i18n instance
  let url = `${window.location.origin}/wp-json/rankmath/v1/employees`;
  let results;

  const getPosts = async () => {
    const { data } = await axios.get(url); // axios call and destructure the data
    setPosts(data);
  };

  useEffect(() => {
    getPosts();
  }, []);

  //   Filter the data by the selected value
  const fiteredData = () => {
    results = posts
      .filter((post) => {
        return (
          new Date(post.activedate).getTime() > new Date().getTime() - value * 24 * 60 * 60 * 1000
        );
      })
      .map((post) => {
        return post;
      });
  };

  //   init fun call
  fiteredData();

  const handleChange = (e) => {
    let lastDays = parseInt(e.target.value);
    setValue(lastDays);
    fiteredData(); // re-filter the data by the selected value
  };
  return (
    <I18nextProvider i18n={i18n}>
      <div className="chart-header">
        <h2> {t('graphWidget')}</h2>
        <select
          name="rankmath_widget"
          id="rankmath_widget"
          onChange={handleChange}
          value={value}
        >
          <option value="7">{t('last7days')} </option>
          <option value="15">{t('last15days')} </option>
          <option value="30">{t('last30days')} </option>
        </select>
      </div>
      <hr />
      <LineChart
        width={400}
        height={300}
        data={results != '' ? results : posts}
        margin={{ top: 5, right: 10, left: -30, bottom: 5 }}
      >
        <Line type="monotone" dataKey="price" stroke="#8884d8" />
        <CartesianGrid stroke="#ccc" strokeDasharray="5 5" />
        <XAxis dataKey="writer" />
        <YAxis />
        <Tooltip />
      </LineChart>
    </I18nextProvider>
  );
};

export default Dashboard;

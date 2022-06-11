import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import { Input, Table, Pagination, Image, Button, Dropdown } from "semantic-ui-react";
import axios from "axios";

import "semantic-ui-css/semantic.min.css";

function App() {
    const [data, setData] = useState([]);
    const [pagination, setPagination] = useState({
        nowActivePage: 1,
        totalPages: 10,
        // total: 10,
    });
    const [searchData, setSearchData] = useState("");
    const httpOption = [
        {key:'http://', value:'http://', text: 'http://'},
        {key:'https://', value:'https://', text:'https://'}
    ]   ;
    const [http, setHttp] = useState(httpOption[0].value)

    /**
     * 查詢
     */
    const search = () => {
        console.log(searchData)
        axios.
            get("/api/crawler", {
                params: !searchData ? undefined : {
                    url: `${http}${searchData}`
                }
            })
            .then((res) => {
                if (!res) {
                    return
                }
                console.log(res)
                handlePaginationChange({activePage: 1})
            })
            .catch((err) => {
                console.log(err);
            })
    };

    /**
     * 換分頁
     */
    const handlePaginationChange = (page) => {
        console.log(page);
        getCrawlerList(page.activePage)
    };

    const getCrawlerList = (nowActivePage = pagination.nowActivePage) => {
        console.log(nowActivePage);
        axios
            .get("/api/getCrawlerList", {
                params: {
                    page: nowActivePage
                },
            })
            .then((res) => {
                if (!res.data) {
                    return;
                }
                console.log(res.data);
                setData(res.data.data.data);
                setPagination({
                    nowActivePage: res.data.data.current_page,
                    totalPages: res.data.data.last_page,
                    // total: res.data.total,
                })
            })
            .catch((err) => {
                // 打失敗的時候
                console.log(err);
            });
    };

    useEffect(() => getCrawlerList(), []);
    return (
        <div className="app">
            <Input
                label={
                    <Dropdown onChange={(e, d) => setHttp(d.value)} defaultValue='http://' options={httpOption}
                />}
                onChange={(e, d) => setSearchData(d.value)}
                placeholder="請輸入url"
            />
            <Button name="search" content="submit" onClick={search} />

            <Table singleLine>
                <Table.Header>
                    <Table.Row>
                        <Table.HeaderCell content="ScreenShot" />
                        <Table.HeaderCell content="title" />
                        <Table.HeaderCell content="description" />
                        <Table.HeaderCell content="body" />
                        <Table.HeaderCell content="createdAt" />
                    </Table.Row>
                </Table.Header>

                <Table.Body>
                    {data && data.map((v) => (
                        <Table.Row key={v.id}>
                            <Table.Cell>
                                <Image src={`${location.origin}:${location.port}${v.screenshot}`} />
                            </Table.Cell>
                            <Table.Cell>
                                <a href={v.link}>{v.title}</a>
                            </Table.Cell>
                            <Table.Cell content={v.description} />
                            <Table.Cell className="bct" content={v.body} />
                            <Table.Cell content={v.created_at} />
                        </Table.Row>
                    ))}
                </Table.Body>
            </Table>

            <Pagination
                activePage={pagination.nowActivePage}
                totalPages={pagination.totalPages}
                onPageChange={(e, data) => handlePaginationChange(data)}
            />
        </div>
    );
}

ReactDOM.render(<App />, document.getElementById("root"));
